<? defined('SYSPATH') or die('No direct script access.'); 

echo Form::open($url); 
?>
<center>
<div class="login">
    <table width="80%" border="0">
        <tr>
            <td align="center">
                <table width="100%">
                    <tr>
                        <td><?php echo Form::input('username','',array('id' => 'username','class'=>'form-control','placeholder'=>'Username')); ?></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                    </tr>
                    <tr>
                        <td height="28"><?php echo Form::password('password','',array('id' => 'password','class'=>'form-control','placeholder'=>'Password')) ?></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                    </tr>
                    <tr>
                        <td><? echo Captcha::instance()."&nbsp;".Form::input('security_code','',array('id' => 'security_code','class' => 'security_code','placeholder'=>'Security Code')); ?></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                    </tr>
                    <tr>
                        <td><?php echo Form::submit('submit','Login',array('class'=>'form-control btn btn-warning btn-sm')) ?></td>
                    </tr>
          		</table></td>
        </tr>
	</table>
</div>
</center>
<? echo Form::close(); ?>
