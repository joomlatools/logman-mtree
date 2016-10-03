<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2016 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Mosets Tree LOGman plugin.
 *
 * Provides event handlers for dealing with com_mtree events.
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanMtree extends ComLogmanPluginJoomla
{
    protected function _getListingObjectData($data, $event)
    {
        $id = $data->link_id;

        $items = $this->_getItems($id, new KObjectConfig());

        $item = current($items);

        return array('id' => $id, 'name' => $item->link_name);
    }

    protected function _getItems($ids, KObjectConfig $config)
    {
        $ids = (array) $ids;

        $adapter = $this->getObject('lib:database.adapter.mysqli');

        if (is_array(current($ids))) {
            $ids = array_pop($ids); // Deal with bad argument.
        }

        $query = $this->getObject('lib:database.query.select')
                      ->table('mt_links')
                      ->where('link_id IN :ids')
                      ->bind(array('ids' => $ids));

        $items = $adapter->select($query, KDatabase::FETCH_OBJECT_LIST);

        return $items;
    }
}