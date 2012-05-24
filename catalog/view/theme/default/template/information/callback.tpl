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
 */

 ?>


<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>

  <div class="callback-text">
    <?php echo $text_desciption; ?>
  </div>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact">
    <div class="content">

      <table class="information">

        <tr>
          <td class="entry">
              <?php echo $entry_name; ?>
          </td>
          <td>
              <input type="text" name="name" value="<?php echo $name; ?>" />
              <?php if ($error_name) { ?>
                <span class="error"><?php echo $error_name; ?></span>
              <?php } ?>
          </td>
        </tr>


        <tr>
          <td class="entry">
            <?php echo $entry_phone; ?>
          </td>
          <td>
            <input type="text" name="phone" value="<?php echo $phone; ?>" />

            <?php if ($error_phone) { ?>
                <span class="error"><?php echo $error_phone; ?></span>
            <?php } ?>
          </td>
        </tr>

        <tr>
          <td class="entry">
            <?php echo $entry_subject; ?>
          </td>
          <td>
            <select name="subject">
              <?php foreach ($entry_subject_items as $entry_subject_item) { ?>
                <option value="<?php echo $entry_subject_item; ?>" <?php echo (isset($this->request->post['subject']) && $entry_subject_item == $this->request->post['subject'] ?'selected="selected"':false); ?>><?php echo $entry_subject_item; ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>

        <tr>
          <td class="entry">
            <?php echo $entry_enquiry; ?>
          </td>
          <td>
            <textarea name="enquiry" cols="40" rows="10" style="width: 99%;"><?php echo $enquiry; ?></textarea>
              <?php if ($error_enquiry) { ?>
              <span class="error"><?php echo $error_enquiry; ?></span>
              <?php } ?>
          </td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>
            <a onclick="$('#contact').submit();" class="button"><span><?php echo $this->language->get('text_send'); ?></span></a>
          </td>
        </tr>

      </table>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>
