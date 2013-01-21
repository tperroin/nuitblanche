<?php

namespace SC2Chart;

/**
 * todo :
 * personnalisation des dimensions
 * personnalisation des couleurs
 * personnalisation des polices
 */
class SC2Chart
{
	protected $file;
	protected $analyzer;
	protected $charter;

	protected $chartWidth		= 481;
	protected $chartHeight		= 160;
	protected $chartPrecision	= 5;

	public function __construct($file, AnalyzerInterface $analyzer, CharterInterface $charter)
	{
		$this->file		= $file;
		$this->analyzer = $analyzer;
		$this->charter	= $charter;
	}

	public function populate($filename = '')
	{
		$replay = $analyzer->process($this->file, $this);
		$charter->create($replay, $filename, $this);
	}

	public function locateFont($name, $bold = false)
	{
		$base = dirname(__FILE__) . '/Resources/fonts/';
		$file = strtoupper($name) . ($bold ? 'B' : '') . '.ttf';

		$file_path = $base . '/' . $file;
		if(!file_exists($file_path))
		{
			throw new \RuntimeException('Impossible to locate font file "' . $file . '"');
		}

		return $file_path;
	}

	public function getChartWidth()
	{
		return $this->chartWidth;
	}

	public function setChartWidth($chartWidth)
	{
		$this->chartWidth = $chartWidth;
	}

	public function getChartHeight()
	{
		return $this->chartHeight;
	}

	public function setChartHeight($chartHeight)
	{
		$this->chartHeight = $chartHeight;
	}

	public function getChartPrecision()
	{
		return $this->chartPrecision;
	}

	public function setChartPrecision($chartPrecision)
	{
		$this->chartPrecision = $chartPrecision;
	}
}