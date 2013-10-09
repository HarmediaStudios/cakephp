<div id="container">
    <div class="form well" id="create_form">
        <?php echo $this->Form->create('VirtualUser'); ?>
        <fieldset>
            <legend><?php echo __('Create New Email Address'); ?></legend>
            <?php echo $this->Form->input('username'); ?>
            <?php echo $this->Form->input('password', array('type' => 'password')); ?>
            <?php echo $this->Form->input(
                'domain_id', 
                array(
                    'type' => 'select',
                    'selected' => $domain_id,
                    'options' => $list_virtual_domains, 
                    'empty' => true, 
                    'div' => array(
                        'class' => ''
                    )
                )
            ); ?>
            <?php echo $this->Form->hidden('valid_email_url', array('value' => Router::url('/mail/get_existing_email'))); ?>
            <?php echo $this->Form->hidden('list_emails_url', array('value' => Router::url('/mail/list_emails'))); ?>
            <div id="isExistingEmail"></div>
            <?php echo $this->Form->input('email', array('readonly')); ?>
        </fieldset>
        <?php echo $this->Form->submit(__('Create Email Address')); ?>
        <?php echo $this->Form->end() ?>
    </div>
    <div id="list_emails_wrapper">
        Existing Emails: </br/><br/>
        <div id="list_emails">

        </div>
    </div>
</div>