{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<div class="message-error">
<h2><span class="time">[{currentdate()|l10n( shortdatetime )}]</span> {'Incompatible product type. (2)'|i18n( 'design/admin/error/shop' )}</h2>
<p>{'The requested object and current basket have incompatible price datatypes.'|i18n( 'design/admin/error/shop' )}</p>
</div>


{section show=$embed_content}
    {$embed_content}
{/section}