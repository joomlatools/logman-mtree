<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2017 Timble CVBA. (http://www.timble.net)
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
        if (!isset($data->link_name))
        {
            $items           = $this->_getItems($data->link_id, new KObjectConfig());
            $item            = array_pop($items);
            $data->link_name = $item->link_name;
        }

        return array('id' => $data->link_id, 'name' => $data->link_name);
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

    public function onContentAfterSave($context, $content, $isNew)
    {
        $data = array(
            'context' => $context,
            'data'    => $content,
            'event'   => 'onContentAfterSave'
        );

        $task = $this->getObject('request')->getData()->task;

        if (isset($task) && $task == 'approve_publish_links')
        {
            $data['verb']   = 'approve';
            $data['result'] = 'approved';
        }
        else  $data['verb'] = $isNew ? 'add' : 'edit';

        $this->log($data);
    }

    public function onContentChangeState($context, $pks, $state)
    {
        $data = $this->getObject('request')->getData();

        if (isset($data->task) && in_array($data->task, array('link_publish', 'link_unpublish'))) {
            parent::onContentChangeState($context, $pks, $state);
        }
    }
}