<?php /* Smarty version Smarty-3.1.6, created on 2017-04-14 12:48:42
         compiled from "C:/wamp/www/ourSecret/shop/Admin/View\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:370458ef278d320836-36351899%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '046c9cf6ba7afd6e5d253707c8f52c931e9c100b' => 
    array (
      0 => 'C:/wamp/www/ourSecret/shop/Admin/View\\Index\\index.html',
      1 => 1492145174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '370458ef278d320836-36351899',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_58ef278d35928',
  'variables' => 
  array (
    'mg_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58ef278d35928')) {function content_58ef278d35928($_smarty_tpl) {?><!doctype html public "-//w3c//dtd xhtml 1.0 frameset//en" "http://www.w3.org/tr/xhtml1/dtd/xhtml1-frameset.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <meta http-equiv=pragma content=no-cache />
        <meta http-equiv=cache-control content=no-cache />
        <meta http-equiv=expires content=-1000 />
        
        <title>管理中心 v1.0</title>
    </head>
    <frameset border=0 framespacing=0 rows="60, *" frameborder=0>
        <frame name=head src="<?php echo @__CONTROLLER__;?>
/head/mg_id/<?php echo $_smarty_tpl->tpl_vars['mg_id']->value;?>
" frameborder=0 noresize scrolling=no>
            <frameset cols="170, *">
                <frame name=left src="<?php echo @__CONTROLLER__;?>
/left" frameborder=0 noresize />
                <frame name=right src="<?php echo @__CONTROLLER__;?>
/right/mg_id/<?php echo $_smarty_tpl->tpl_vars['mg_id']->value;?>
" frameborder=0 noresize scrolling=yes />
            </frameset>
    </frameset>
    <noframes>
    </noframes>
</html><?php }} ?>