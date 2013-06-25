<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PieChart Object
 *
 * Holds all the configuration for the PieChart
 *
 * Rows: Each row in the table represents a slice.
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

class PieChart extends Chart
{
    public function __construct($chartLabel)
    {
        parent::__construct($chartLabel);

        $this->defaults = array_merge($this->defaults, array(
            'is3D',
            'reverseCategories'
        ));
    }

    /**
     * Sets configuration options from array of values
     *
     * You can set the options all at once instead of passing them individually
     * or chaining the functions from the chart objects.
     *
     * @param array $options
     * @return \PieChart
     */
//    public function setConfig($options = array())
//    {
//        return parent::setConfig($options);
//    }

    /**
     * If set to true, displays a three-dimensional chart.
     *
     * @param boolean $is3D
     * @return \PieChart
     */
    public function is3D($is3D)
    {
        if(is_bool($is3D))
        {
            $this->addOption(array('is3D' => $is3D));
        } else {
            $this->error('Invalid value for is3D, must be type (boolean).');
        }

        return $this;
    }

    public function reverseCategories($reverseCategories)
    {
        if(is_bool($reverseCategories))
        {
            $this->addOption(array('reverseCategories' => $reverseCategories));
        } else {
            $this->error('Invalid value for reverseCategories, must be type (boolean).s');
        }
    }

}

/* End of file PieChart.php */
/* Location: ./application/libraries/gcharts/PieChart.php */
