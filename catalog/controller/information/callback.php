<?php

/**
 * OpenCart Ukrainian Community
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License, Version 3
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/copyleft/gpl.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@opencart-ua.org so we can send you a copy immediately.
 *
 * @category   OpenCart
 * @package    OCU Callback
 * @copyright  Copyright (c) 2011 Eugene Kuligin by OpenCart Ukrainian Community (http://opencart-ua.org)
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU General Public License, Version 3
 * @version    $Id: admin/language/shipping/ocu_ukrposhta.php 1 2011-11-19 01:07:46
 */

class ControllerInformationCallback extends Controller {

    private $error = array();

      public function index()
      {
        $this->language->load('information/callback');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $body  = sprintf($this->language->get('email_entry_phone'), $this->request->post['phone']) . "\n\n";
            $body .= sprintf($this->language->get('email_entry_subject'), strip_tags(html_entity_decode($this->request->post['subject'], ENT_QUOTES, 'UTF-8'))) . "\n\n";
            $body .= sprintf($this->language->get('email_entry_enquiry'), strip_tags(html_entity_decode($this->request->post['enquiry'], ENT_QUOTES, 'UTF-8')));

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->hostname = $this->config->get('config_smtp_host');
            $mail->username = $this->config->get('config_smtp_username');
            $mail->password = $this->config->get('config_smtp_password');
            $mail->port = $this->config->get('config_smtp_port');
            $mail->timeout = $this->config->get('config_smtp_timeout');
            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->request->post['name']);
            $mail->setSubject(sprintf($this->language->get('email_subject'), $this->request->post['name']));
            $mail->setText($body);
            $mail->send();

            $this->redirect($this->url->link('information/callback/success'));
        }

          $this->data['breadcrumbs'] = array();

          $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
          );

          $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('information/callback'),
            'separator' => $this->language->get('text_separator')
          );

        $this->data['heading_title'] = $this->language->get('heading_title');


        $this->data['text_callback'] = $this->language->get('text_callback');
        $this->data['text_desciption'] = $this->language->get('text_desciption');


        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_phone'] = $this->language->get('entry_phone');
        $this->data['entry_subject'] = $this->language->get('entry_subject');

        $this->data['entry_subject_items'] = array(
            $this->language->get('entry_subject_1'),
            $this->language->get('entry_subject_2'),
            $this->language->get('entry_subject_3'),
        );

        $this->data['entry_enquiry'] = $this->language->get('entry_enquiry');

        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = '';
        }

        if (isset($this->error['phone'])) {
            $this->data['error_phone'] = $this->error['phone'];
        } else {
            $this->data['error_phone'] = '';
        }

        if (isset($this->error['enquiry'])) {
            $this->data['error_enquiry'] = $this->error['enquiry'];
        } else {
            $this->data['error_enquiry'] = '';
        }

        $this->data['button_continue'] = $this->language->get('button_continue');

        $this->data['action'] = $this->url->link('information/callback');
        $this->data['store'] = $this->config->get('config_name');
        $this->data['address'] = nl2br($this->config->get('config_address'));
        $this->data['telephone'] = $this->config->get('config_telephone');
        $this->data['fax'] = $this->config->get('config_fax');

        if (isset($this->request->post['name'])) {
            $this->data['name'] = $this->request->post['name'];
        } else {
            $this->data['name'] = $this->customer->getFirstName();
        }

        if (isset($this->request->post['phone'])) {
            $this->data['phone'] = $this->request->post['phone'];
        } else {
            $this->data['phone'] = '';
        }

        if (isset($this->request->post['enquiry'])) {
            $this->data['enquiry'] = $this->request->post['enquiry'];
        } else {
            $this->data['enquiry'] = '';
        }


        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/callback.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/information/callback.tpl';
        } else {
            $this->template = 'default/template/information/callback.tpl';
        }

        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );

         $this->response->setOutput($this->render());
      }

      public function success()
      {
        $this->language->load('information/callback');

        $this->document->setTitle($this->language->get('heading_title'));

          $this->data['breadcrumbs'] = array();

          $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
          );

          $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('information/callback'),
            'separator' => $this->language->get('text_separator')
          );

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_message'] = $this->language->get('text_message');

        $this->data['button_continue'] = $this->language->get('button_continue');

        $this->data['continue'] = $this->url->link('common/home');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/common/success.tpl';
        } else {
            $this->template = 'default/template/common/success.tpl';
        }

        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );

         $this->response->setOutput($this->render());
    }


      private function validate()
      {
        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
              $this->error['name'] = $this->language->get('error_name');
        }

        if (empty($this->request->post['phone'])) {
              $this->error['phone'] = $this->language->get('error_phone');
        }

        if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
              $this->error['enquiry'] = $this->language->get('error_enquiry');
        }

        if (!$this->error) {
              return true;
        } else {
              return false;
        }
      }
}
