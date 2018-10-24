{* DO NOT EDIT THIS FILE! Use an override template instead. *}

{let settings_list=ezini( 'DebugSettings', 'QuickSettingsList', 'site.ini' )}

<form id="quicksettings" action={'setup/settingstoolbar'|ezurl} method="post">

{default ui_context=''}

<div class="block">
<input type="hidden" name="SiteAccess" value="{$siteaccess|wash}" />

{section show=eq( $siteaccess, 'global_override' )}
   {section loop=$settings_list}
     <input type="hidden" name="AllSettingsList[]" value="{$:item|wash}"/>
     {let setting=$:item|explode( ';' )}
     {let debug_output=ezini( $setting.0, $setting.1, $setting.2, 'settings/override', true )}
      <label>
      <input type="checkbox" {or( eq( $debug_output, 'enabled' ), eq( $debug_output, 'true' ) )|choose( '', 'checked="checked" ' )}name="SelectedList[]" value="{$:index}" />
         {section show=eq( $debug_output, '' )}
            <span class="disabled">{$setting.3|wash}</span>
         {section-else}
            {$setting.3|wash}
         {/section}
     </label>
     {/let}
     {/let}
   {/section}
{section-else}
   {section loop=$settings_list}
      <input type="hidden" name="AllSettingsList[]" value="{$:item|wash}" />
      {let setting=$:item|explode( ';' )}
      {let debug_output=ezini( $setting.0, $setting.1, $setting.2, concat( 'settings/siteaccess/', $siteaccess ), true )
           debug_output_override=ezini( $setting.0, $setting.1, $setting.2, 'settings/override', true )}
         <label>
      {section show=ne( $debug_output_override, '' )}
         <input type="checkbox"{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )} {or( eq( $debug_output_override, 'enabled' ), eq( $debug_output_override, 'true' ) )|choose( '', 'checked="checked" ' )}name="SelectedList[]" value="{$:index}" />
         <span class="overriden">{$setting.3|wash}</span>
      {section-else}
         {section show=eq( $debug_output, '' )}
            <input type="checkbox"{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )} {or( eq( ezini( $setting.0, $setting.1, $setting.2 ), 'enabled' ), eq( ezini( $setting.0, $setting.1, $setting.2 ), 'true' ) )|choose( '', 'checked="checked" ' )}name="SelectedList[]" value="{$:index}" />
         {section-else}
            <input type="checkbox"{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )} {or( eq( $debug_output, 'enabled' ), eq( $debug_output, 'true' ) )|choose( '', 'checked="checked" ' )}name="SelectedList[]" value="{$:index}" />
         {/section}
            {$setting.3|wash}
      {/section}
         </label>
      {/let}
      {/let}
   {/section}
{/section}
</div>
{section show=eq( $select_siteaccess, true )}
    {let siteaccesslist=ezini( 'SiteAccessSettings', 'RelatedSiteAccessList' )}
    <div class="block">
    <label>Siteaccess:</label>
    <select name="siteaccesslist"{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )} onchange='location.href=this.value'>
            <option value={'/user/preferences/set/admin_quicksettings_siteaccess/global_override'|ezurl}{section show=eq( $siteaccess, 'global_override')} selected="selected"{/section}>Global (override)</option>
    {section loop=$siteaccesslist}
            <option value={concat( '/user/preferences/set/admin_quicksettings_siteaccess/', $:item )|ezurl}{section show=eq( $siteaccess, $:item )} selected="selected"{/section}>{$:item|wash}</option>
    {/section}
    </select>
    </div>
    {/let}
{/section}
<div class="block">
<input {eq( $ui_context, 'edit' )|choose( "class='button'", "class='button-disabled'" )}{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )} type="submit" name="SetButton" value="Set" />
</div>

{/default}
</form>
{/let}
