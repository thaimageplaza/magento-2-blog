<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Blog
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Blog\Controller\Adminhtml\Post;

use Mageplaza\Blog\Controller\Adminhtml\Post;

/**
 * Class Delete
 * @package Mageplaza\Blog\Controller\Adminhtml\Post
 */
class Delete extends Post
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $this->postFactory->create()
                    ->load($id)
                    ->delete();

                $this->messageManager->addSuccess(__('The Post has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $resultRedirect->setPath('mageplaza_blog/*/edit', ['id' => $id]);

                return $resultRedirect;
            }
        } else {
            $this->messageManager->addError(__('Post to delete was not found.'));
        }

        $resultRedirect->setPath('mageplaza_blog/*/');

        return $resultRedirect;
    }
}
