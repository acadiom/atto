<?php
namespace Atto\Blade;

use Atto\Blade\Engines\Engine;

class Factory {
	
	/**
	 * Views path
	 * 
	 * @var string
	 */
	protected $viewsPath;
	
	/**
	 * Register a view extension with the finder.
	 *
	 * @var array
	 */
	protected $extensions = ['blade.php', 'php'];
	
	/**
	 * The engine implementation.
	 *
	 * @var Engine
	 */
	protected $engine;

	/**
	 * Data that should be available to all templates.
	 *
	 * @var array
	 */
	protected $shared = [];
	
	/**
	 * The number of active rendering operations.
	 *
	 * @var int
	 */
	protected $renderCount = 0;
	
	/**
	 * All of the finished, captured sections.
	 *
	 * @var array
	 */
	protected $sections = [];
	
	/**
	 * The stack of in-progress sections.
	 *
	 * @var array
	 */
	protected $sectionStack = [];
	
	/**
	 * Create a new view factory instance.
	 *
	 * @param Engine $engine
	 * @param string $viewsPath Path where the views are located
	 */
	public function __construct(Engine $engine, $viewsPath) {
		$this->engine    = $engine;
		$this->viewsPath = $viewsPath;
		
		$this->share('__env', $this);
	}
	
	/**
	 * Get all of the shared data for the environment.
	 *
	 * @return array
	 */
	public function getShared() {
		return $this->shared;
	}
	
	/**
	 * Increment the rendering counter.
	 *
	 * @return void
	 */
	public function incrementRender() {
		$this->renderCount++;
	}
	
	/**
	 * Decrement the rendering counter.
	 *
	 * @return void
	 */
	public function decrementRender() {
		$this->renderCount--;
	}
	
	/**
	 * Add a piece of shared data to the environment.
	 *
	 * @param  array|string $key
	 * @param  mixed        $value
	 *
	 * @return void
	 */
	public function share($key, $value = null) {
		if (!is_array($key)) {
			$this->shared[$key] = $value;
			return;
		}
	
		foreach ($key as $innerKey => $innerValue) {
			$this->share($innerKey, $innerValue);
		}
	}
	
	/**
	 * Find the given view in the list of paths.
	 *
	 * @param  string $name
	 *
	 * @return string
	 *
	 * @throws \InvalidArgumentException
	 */
	protected function find($name) {
		
		foreach ($this->extensions as $ext) {
			$viewPath = $this->viewsPath . '/' . str_replace('.', '/', $name) . '.' . $ext;
			
			if (file_exists($viewPath)) {
				return $viewPath;
			}
		}
	
		throw new \InvalidArgumentException("View [$name] not found.");
	}
	
	/**
	 * Check if there are no active render operations.
	 *
	 * @return bool
	 */
	public function doneRendering() {
		return $this->renderCount === 0;
	}
	
	/**
	 * Flush all of the section contents.
	 *
	 * @return void
	 */
	public function flushSections() {
		$this->sections     = [];
		$this->sectionStack = [];
	}
	
	/**
	 * Get the evaluated view contents for the given view.
	 *
	 * @param  string $view
	 * @param  array  $data
	 *
	 * @return View
	 */
	public function make($view, $data = []) {
		// Normalize view name
		$view = str_replace('/', '.', $view);
		$path = $this->find($view);
		
		return new View($this, $this->engine, $view, $path, $data);
	}
	
	/**
	 * Start injecting content into a section.
	 *
	 * @param  string $section
	 * @param  string $content
	 *
	 * @return void
	 */
	public function startSection($section, $content = '') {
		if ($content === '') {
			if (ob_start()) {
				$this->sectionStack[] = $section;
			}
		} else {
			$this->extendSection($section, $content);
		}
	}
	
	/**
	 * Stop injecting content into a section.
	 *
	 * @param  bool $overwrite
	 *
	 * @return string
	 */
	public function stopSection($overwrite = false) {
		$last = array_pop($this->sectionStack);
	
		if ($overwrite) {
			$this->sections[$last] = ob_get_clean();
		} else {
			$this->extendSection($last, ob_get_clean());
		}
	
		return $last;
	}
	
	/**
	 * Append content to a given section.
	 *
	 * @param  string $section
	 * @param  string $content
	 *
	 * @return void
	 */
	protected function extendSection($section, $content) {
		if (isset($this->sections[$section])) {
			$content = str_replace('@parent', $content, $this->sections[$section]);
		}
	
		$this->sections[$section] = $content;
	}

	/**
	 * Stop injecting content into a section and return its contents.
	 *
	 * @return string
	 */
	public function yieldSection() {
		return $this->yieldContent($this->stopSection());
	}
	
	/**
	 * Get the string contents of a section.
	 *
	 * @param  string $section
	 * @param  string $default
	 *
	 * @return string
	 */
	public function yieldContent($section, $default = '') {
		$sectionContent = $default;
	
		if (isset($this->sections[$section])) {
			$sectionContent = $this->sections[$section];
		}
	
		$sectionContent = str_replace('@@parent', '--parent--holder--', $sectionContent);
	
		return str_replace('--parent--holder--', '@parent', str_replace('@parent', '', $sectionContent));
	}
	
	/**
	 * Escape HTML entities in a string.
	 *
	 * @param  string $value
	 *
	 * @return string
	 */
	public function e($value) {
		return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
	}
	
	/**
	 * Get all of the given array except for a specified array of items.
	 *
	 * @param  array        $array
	 * @param  array|string $keys
	 *
	 * @return array
	 */
	public function array_except($array, $keys) {
		foreach ((array) $keys as $key) {
			unset($array[$key]);
		}
	
		return $array;
	}
}

