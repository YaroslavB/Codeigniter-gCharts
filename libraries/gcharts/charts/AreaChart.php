<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * AreaChart Object
 *
 * Holds all the configuration for the AreaChart
 *
 *
 * NOTICE OF LICENSE
 *
 * You should have received a copy of the MIT License along with this project.
 * If not, see <http://opensource.org/licenses/MIT>.
 *
 *
 * @author Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2013, KHill Designs
 * @link https://github.com/kevinkhill/Codeigniter-gCharts GitHub Repository Page
 * @link http://kevinkhill.github.io/Codeigniter-gCharts/ GitHub Project Page
 * @license http://opensource.org/licenses/MIT MIT
 */

class AreaChart
{
    var $chartType = NULL;
    var $chartLabel = NULL;
    var $dataTable = NULL;

    var $data = NULL;
    var $options = NULL;
    var $events = NULL;
    var $elementID = NULL;

    public function __construct($chartLabel)
    {
        $this->chartType = get_class($this);
        $this->chartLabel = $chartLabel;
        $this->options = array();
    }

    /**
     * Sets configuration options from array of values
     *
     * You can set the options all at once instead of passing them individually
     * or chaining the functions from the chart objects.
     *
     * @param array $options
     * @return \AreaChart
     */
    public function initialize($options = array())
    {
        $defaultOptions = array(
//            'animation',
            'areaOpacity',
            'backgroundColor',
            'chartArea',
            'colors',
            'curveType',
            'enableInteractivity',
            'events',
            'focusTarget',
            'fontSize',
            'fontName',
            'hAxis',
            'isHtml',
            'interpolateNulls',
            'legend',
            'lineWidth',
            'pointSize',
            'reverseCategories',
            'series',
            'theme',
            'title',
            'titlePosition',
            'titleTextStyle',
            'tooltip',
            'vAxes',
            'vAxis'
        );

        if(is_array($options) && count($options) > 0)
        {
            foreach($options as $option => $value)
            {
                if(in_array($option, $defaultOptions))
                {
                    if(method_exists($this, $option))
                    {
                        $this->$option($value);
                    } else {
                        $this->addOption($value);
                    }
                }
            }
        } else {
            $this->error('Invalid config value, must be type (array) containing any key '.array_string($defaultOptions));
        }

        return $this;
    }

    /**
     * Adds the error message to the error log in the gcharts master object.
     *
     * @param string $msg
     */
    private function error($msg)
    {
        Gcharts::_set_error($this->chartType, $msg);
    }

    /**
     * Sets a configuration option
     *
     * Takes either an array with option => value, or an object created by
     * one of the configOptions child objects.
     *
     * @param mixed $option
     * @return \AreaChart
     */
    public function addOption($option)
    {
        if(is_object($option))
        {
            $this->options = array_merge($this->options, $option->toArray());
        }

        if(is_array($option))
        {
            $this->options = array_merge($this->options, $option);
        }

        return $this;
    }

    /**
     * Assigns wich DataTable will be used for this AreaChart.
     *
     * There are two possible uses of this method:
     *
     * If a (string) label is provided then the chart will use the previously
     * defined and labeled DataTable stored within the gcharts object.
     *
     * If a DataTable object is passed, then that is the data table that will be
     * used for the chart.
     *
     * @param mixed $data String label or DataTable object
     * @return \gcharts\configs\DataTable
     */
    public function dataTable($data)
    {
        if(is_a($data, 'DataTable'))
        {
            $this->data = $data;
            $this->dataTable = 'local';
        } else {
            if(is_string($data) && $data != '')
            {
                $this->dataTable = $data;
            } else {
                $this->error('Invalid argument, must be a label type (string) or a data table type (DataTable).');
            }
        }

        return $this;
    }

    /**
     * Register javascript callbacks for specific events. Valid values include
     * [ animationfinish | error | onmouseover | onmouseout | ready | select ]
     * associated to a respective pre-defined javascript function as the callback.
     *
     * @param array $events Array of events associated to a callback
     * @return \AreaChart
     */
    public function events($events)
    {
        $values = array(
            'animationfinish',
            'error',
            'onmouseover',
            'onmouseout',
            'ready',
            'select'
        );

        if(is_array($events))
        {
            foreach($events as $event)
            {
                if(in_array($event, $values))
                {
                    $this->events[] = $event;
                } else {
                    $this->error('Invalid events array key value, must be (string) with any key '.array_string($values));
                }
            }
        } else {
            Gcharts::_set_error($this->chartType, 'Invalid events type, must be (array) containing any key '.array_string($values));
        }

        return $this;
    }


    /**
     * Animation Easing
     *
     * The easing function applied to the animation. The following options are available:
     * 'linear' - Constant speed.
     * 'in' - Ease in - Start slow and speed up.
     * 'out' - Ease out - Start fast and slow down.
     * 'inAndOut' - Ease in and out - Start slow, speed up, then slow down.
     *
     * @param string $easing
     * @return \AreaChart
     */
//    public function animationEasing($easing = 'linear')
//    {
//        $values = array('linear', 'in', 'out', 'inAndOut');
//
//        if(in_array($easing, $values))
//        {
//            $this->easing = $easing;
//            return $this;
//        } else {
//            $this->error('Invalid animationEasing value, must be (string) '.array_string($values));
//        }
//
//        return $this;
//    }

    /**
     * Animation Duration
     *
     * The duration of the animation, in milliseconds.
     *
     * @param mixed $duration
     * @return \AreaChart
     */
//    public function animationDuration($duration)
//    {
//        if(is_int($duration) || is_string($duration))
//        {
//            $this->duration = $this->_valid_int($duration);
//        } else {
//            $this->duration = 0;
//        }
//
//        return $this;
//    }

    /**
     * The default opacity of the colored area under an area chart series, where
     * 0.0 is fully transparent and 1.0 is fully opaque. To specify opacity for
     * an individual series, set the areaOpacity value in the series property.
     *
     * @param float $opacity
     * @return \AreaChart
     */
    public function areaOpacity($opacity)
    {
        if(is_float($opacity) && $opacity < 1.0 && $opacity > 0.0)
        {
            $this->addOption(array('areaOpacity' => $opacity));
        } else {
            $this->error('Invalid areaOpacity, must be type (float) between 0.0 - 1.0');
        }

        return $this;
    }

    /**
     * Where to place the axis titles, compared to the chart area. Supported values:
     *
     * in - Draw the axis titles inside the the chart area.
     * out - Draw the axis titles outside the chart area.
     * none - Omit the axis titles.
     *
     * @param string $position
     * @return \AreaChart
     */
    public function axisTitlesPosition($position)
    {
        $values = array('in', 'out', 'none');

        if(in_array($position, $values))
        {
            $this->addOption(array('axisTitlesPosition' => $position));
        } else {
            $this->error('Invalid axisTitlesPosition, must be (string) '.array_string($values));
        }

        return $this;
    }

    /**
     * An object with members to configure the placement and size of the chart area
     * (where the chart itself is drawn, excluding axis and legends).
     * Two formats are supported: a number, or a number followed by %.
     * A simple number is a value in pixels; a number followed by % is a percentage.
     *
     * @param \chartArea $chartArea
     * @return \AreaChart
     */
    public function chartArea(chartArea $chartArea)
    {
        if(is_a($chartArea, 'chartArea'))
        {
            $this->addOption($chartArea->toArray());
        } else {
            $this->error('Invalid chartArea, must be (object) type chartArea');
        }

        return $this;
    }

    /**
     * The colors to use for the chart elements. An array of strings, where each
     * element is an HTML color string, for example: colors:['red','#004411'].
     *
     * @param array $colorArray
     * @return \AreaChart
     */
    public function colors($colorArray)
    {
        if(is_array($colorArray))
        {
            $this->addOption(array('colors' => $colorArray));
        } else {
            $this->error('Invalid colors, must be (array) with valid HTML colors');
        }

        return $this;
    }

    /**
     * Controls the curve of the lines when the line width is not zero. Can be one of the following:
     *
     * 'none' - Straight lines without curve.
     * 'function' - The angles of the line will be smoothed.
     *
     * @param string $curveType
     * @return \AreaChart
     */
    public function curveType($curveType = 'none')
    {
        $values = array('none', 'function');

        if(in_array($curveType, $values))
        {
            $this->addOption(array('curveType' => (string) $curveType));
        } else {
            $this->error('Invalid curveType, must be (string) '.array_string($values));
        }

        return $this;
    }

    public function enableInteractivity($param)
    {


        return $this;
    }

    public function focusTarget($param)
    {


        return $this;
    }

    public function fontSize($param)
    {


        return $this;
    }

    public function fontName($param)
    {


        return $this;
    }

    /**
     * An object with members to configure various horizontal axis elements. To
     * specify properties of this property, create a new hAxis() object, set
     * the values then pass it to this function or to the constructor.
     *
     * @param hAxis $hAxis
     * @return \AreaChart
     */
    public function hAxis($hAxis)
    {
        if(is_a($hAxis, 'hAxis'))
        {
            $this->addOption($hAxis->toArray());
        } else {
            $this->error('Invalid hAxis, must be (object) type hAxis');
        }

        return $this;
    }

    /**
     * Height of the chart, in pixels.
     *
     * @param int $height
     * @return \AreaChart
     */
    public function height($height)
    {
        if(is_int($height))
        {
            $this->addOption(array('height' => $height));
        } else {
            $this->error('Invalid height, must be (int)');
        }

        return $this;
    }

    /**
     * If set to true, use HTML-rendered (rather than SVG-rendered) tooltips.
     *
     * @param boolean $isHTML
     * @return \AreaChart
     */
    public function isHtml($isHTML)
    {
        if(is_bool($isHTML))
        {
            $this->addOption(array('isHTML' => $isHTML));
        } else {
            $this->error('Invalid isHTML value, must be type (boolean)');
        }

        return $this;
    }

    /**
     * If set to true, series elements are stacked.
     *
     * @param type $isStacked
     * @return \AreaChart
     */
    public function isStacked($isStacked)
    {
        if(is_bool($isStacked))
        {
            $this->addOption(array('isStacked' => $isStacked));
        } else {
            $this->error('Invalid isStacked value, must be type (boolean)');
        }

        return $this;
    }

    /**
     * Whether to guess the value of missing points. If true, it will guess the
     * value of any missing data based on neighboring points. If false, it will
     * leave a break in the line at the unknown point.
     *
     * @param boolean $interpolateNulls
     * @return \AreaChart
     */
    public function interpolateNulls($interpolateNulls)
    {
        if(is_bool($interpolateNulls))
        {
            $this->addOption(array('interpolateNulls' => $interpolateNulls));
        } else {
            Gcharts::_set_error($where, 'Invalid interpolateNulls value, must be type (boolean)');
        }

        return $this;
    }

    /**
     * An object with members to configure various aspects of the legend. To
     * specify properties of this object, create a new legend() object, set the
     * values then pass it to this function or to the constructor.
     *
     * @param legend $legendObj
     * @return \AreaChart
     */
    public function legend(legend $legendObj)
    {
        if(is_a($legendObj, 'legend'))
        {
            $this->addOption($legendObj->toArray());
        } else {
            $this->error('Invalid legend, must be (object) type legend');
        }

        return $this;
    }

    /**
     * Data line width in pixels. Use zero to hide all lines and show only the
     * points. You can override values for individual series using the series
     * property.
     *
     * @param int $width
     * @return \AreaChart
     */
    public function lineWidth($width = 2)
    {
        if(is_int($width))
        {
            $this->addOption(array('lineWidth' => $width));
        } else {
            $this->error('Invalid lineWidth, must be (int)');
        }

        return $this;
    }

    /**
     * Diameter of displayed points in pixels. Use zero to hide all points. You
     * can override values for individual series using the series property.
     *
     * @param int $size
     * @return \AreaChart
     */
    public function pointSize($size = 0)
    {
        if(is_int($size))
        {
            $this->addOption(array('pointSize' => $size));
        } else {
            $this->error('Invalid pointSize, must be (int)');
        }

        return $this;
    }

    public function reverseCatagories($param)
    {


        return $this;
    }

    public function series($param)
    {


        return $this;
    }

//    public function theme($param)
//    {
//
//
//        return $this;
//    }

    /**
     * Text to display above the chart.
     *
     * @param string $title
     * @return \AreaChart
     */
    public function title($title = '')
    {
        if(is_string($title))
        {
            $this->addOption(array('title' => (string) $title));
        } else {
            $this->error('Invalid title, must be type (string)');
        }

        return $this;
    }

    /**
     * An object with members to configure various tooltip elements. To specify
     * properties of this object, create a new tooltip() object, set the values
     * then pass it to this function or to the constructor.
     *
     * @param tooltip $tooltipObj
     * @return \AreaChart
     */
    public function tooltip(tooltip $tooltipObj)
    {
        if(is_a($tooltipObj, 'tooltip'))
        {
            $this->addOption($tooltipObj->toArray());
        } else {
            $this->error('Invalid tooltip, must be (object) type tooltip');
        }

        return $this;
    }

    /**
     * Where to place the chart title, compared to the chart area. Supported values:
     * 'in' - Draw the title inside the chart area.
     * 'out' - Draw the title outside the chart area.
     * 'none' - Omit the title.
     *
     * @param string $position
     * @return \AreaChart
     */
    public function titlePosition($position)
    {
        $values = array(
            'in',
            'out',
            'none'
        );

        if(in_array($position, $values))
        {
            $this->addOption(array('titlePosition' => $position));
        } else {
            $this->error('Invalid axisTitlesPosition, must be (string) '.array_string($values));
        }

        return $this;
    }

    /**
     * An object that specifies the title text style. create a new textStyle()
     * object, set the values then pass it to this function or to the constructor.
     *
     * @param textStyle $textStyleObj
     * @return \AreaChart
     */
    public function titleTextStyle(textStyle $textStyleObj)
    {
        if(is_a($textStyleObj, 'textStyle'))
        {
            $this->addOption(array('titleTextStyle' => $textStyleObj->values()));
        } else {
            $this->error('Invalid titleTextStyle, must be (object) type textStyle');
        }

        return $this;
    }

    /**
     * Width of the chart, in pixels.
     *
     * @param int $width
     * @return \AreaChart
     */
    public function width($width)
    {
        if(is_int($width))
        {
            $this->addOption(array('width' => $width));
        } else {
            $this->error('Invalid width, must be (int)');
        }

        return $this;
    }

    /**
     * Outputs the chart javascript into the page
     *
     * Pass in a string of the html elementID that you want the chart to be
     * rendered into. Plus, if the dataTable function was never called on the
     * chart to assign a DataTable to use, it will automatically attempt to use
     * a DataTable with the same label as the chart.
     *
     * @param string $elementID
     * @return string Javscript code blocks
     */
    public function outputInto($elementID = '')
    {
        if($this->dataTable === NULL)
        {
            $this->dataTable = $this->chartLabel;
        }

        if(is_string($elementID) && $elementID != '')
        {
            $this->elementID = $elementID;
        }

        return Gcharts::_build_script_block($this);
    }

}

/* End of file AreaChart.php */
/* Location: ./gcharts/charts/AreaChart.php */
