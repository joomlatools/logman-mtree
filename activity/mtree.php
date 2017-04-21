<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2016 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Mosets Tree Activity Entity
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanMtreeActivityMtree extends ComLogmanModelEntityActivity
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'format'        => '{actor} {action} {object.type} name {object}',
            'object_table'  => 'mt_links',
            'object_column' => 'link_id'
        ));

        parent::_initialize($config);
    }

    protected function _objectConfig(KObjectConfig $config)
    {
        $config->append(array('url' => array('admin' => 'option=com_mtree&task=editlink&link_id=' . (int) $this->row)));

        parent::_objectConfig($config);
    }

    public function getPropertyImage()
    {
        if ($this->verb == 'approve') {
            $image = 'k-icon-check';
        } else {
            $image = parent::getPropertyImage();
        }

        return $image;
    }
}