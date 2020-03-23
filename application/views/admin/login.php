<? defined('SYSPATH') or die('No direct script access.'); ?>
<div class="outer_login">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21%" valign="top">
        <div class="login_form">
        <!--div class="login_image"></div!-->
        <?
        echo Form::open($url); 
        ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#D6D6D6">
            <tr>
                <td width="77%" align="center">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="81"><?php echo Form::label('username','Username')."<br>".Form::input('username','',array('id' => 'username')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo Form::label('password','Password')."<br>".Form::password('password','',array('id' => 'password'))."<br><br>".Form::submit('submit','Login',array('class'=>'btn btn-primary btn-sm')); ?></td>
                        </tr>
                    </table></td>
            </tr>
          </table>
          <? echo Form::close(); ?>
        </div></td>
  </tr>
</table>
</div>