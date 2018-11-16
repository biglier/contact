<?php

/**
 * ContactPlugin
 *
 * @category  Slavik\Contact\Plugin;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */


namespace Slavik\Contact\Plugin;

use Magento\Setup\Exception;
use Slavik\Contact\Model\ContactFactory;
use Slavik\Contact\Model\ContactRepository;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\Context;
use Magento\Contact\Model\ConfigInterface;
use Magento\Contact\Model\MailInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;

class ContactPlugin
{
    /**
     * @var ContactFactory
     */
    protected $contactFactory;
    /**
     * @var ContactRepository
     */
    protected $contactRepository;
    /**
     * @var DataPersistorInterface
     */

     private $dataPersistor;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var MailInterface
     */
    private $mail;

    /**
     * @var LoggerInterface
     */
    private $logger;


    /**
     * @param ContactFactory $contactFactory
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactFactory $contactFactory,
                                ContactRepository $contactRepository
    )
    {
        $this->contactFactory = $contactFactory;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param $subject
     * @param $result
     */
    public function afterExecute($subject, $result)
    {

            $request = $subject->getRequest();
            $contact = $this->contactFactory->create();
            $contact ->setData('customer_name',$request->getParam('name'));
            $contact ->setData('customer_email',$request->getParam('email'));
            $contact ->setData('text',$request->getParam('comment'));
            $this->contactRepository->save($contact);
            //$subject->messageManager->addSuccessMessage(
              //  'Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.');

        /**catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
        }
         */
        return $result;
    }
}
