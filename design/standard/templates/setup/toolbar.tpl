{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<form method="post" action={concat("setup/toolbar/",$current_siteaccess,"/",$toolbar_position)|ezurl}>
<h1>{"Tool List for Toolbar_%toolbar_position"|i18n("design/standard/setup/toolbar",,hash( '%toolbar_position', $toolbar_position ))}</h1>

{section show=$tool_list}
<table class="list" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <th width="1">
        &nbsp;
    </th>
    <th colspan="2">
        {"Tool"|i18n("design/standard/setup/toolbar")}
    </th>
    <th>
        {"Placement"|i18n("design/standard/setup/toolbar")}
    </th>
</tr>
{section var=Tool loop=$tool_list sequence=array( bglight, bgdark )}
<tr class="{$Tool.sequence}">
    <td align="right" width="1">
        <input type="checkbox" name="deleteToolArray[]" value="{$Tool.index}" />
    </td>
    <td>
    {section show=eq($toolbar_position,right)}
        <img src={concat( "toolbar/", $Tool.name, ".png" )|ezimage} alt="{$Tool.name}" />
    {section-else}
        <img src={concat( "toolbar/", $Tool.name, "_line.png" )|ezimage} alt="{$Tool.name}" />
    {/section}
    <div>{$Tool.name}</div>
    </td>
    <td>
        <table>
        {section var=Parameter loop=$Tool.parameters}
        <tr>
            <td>
            {$Parameter.description}
            </td>
            <td>
            {switch match=cond( $Parameter.name|ends_with( '_node' ), 1,
                                $Parameter.name|ends_with( '_classidentifier' ), 2,
                                $Parameter.name|ends_with( '_classidentifiers' ), 3,
                                $Parameter.name|ends_with( '_subtree' ), 4,
                                $Parameter.name|ends_with( '_check' ), 5,
                                0 )}
            {case match=1}
                {let used_node=fetch( content, node, hash( node_id, $Parameter.value ) )}
                {section show=$used_node}
                    {$used_node.object.content_class.identifier|class_icon( small, $used_node.object.content_class.name )}&nbsp;{$used_node.name|wash} ({$Parameter.value})
                {section-else}
                    {$Parameter.value|wash}
                {/section}
                {/let}
                <br/>
                <input type="submit" name="BrowseButton[{$Tool.index}_parameter_{$Parameter.name}]" value="{"Browse"|i18n("design/standard/setup/toolbar")}" />
                <input type="hidden" name="{$Tool.index}_parameter_{$Parameter.name}" size="20" value="{$Parameter.value|wash}">
            {/case}
            {case match=2}
                {let class_list=fetch( class, list )}
                <select name="{$Tool.index}_parameter_{$Parameter.name}">
                {section var=class loop=$class_list}
                    <option value="{$class.identifier|wash}" {section show=eq( $class.identifier, $Parameter.value )}selected="selected"{/section}>{$class.name|wash}</option>
                {/section}
                </select>
                {/let}
            {/case}
            {case match=3}
                {let class_list=fetch( class, list ) match_list=$Parameter.value|explode( ',' )}
                <select multiple="multiple" name="CustomInputList[{$Tool.index}_parameter_{$Parameter.name}][]">
                {section var=class loop=$class_list}
                    <option value="{$class.identifier|wash}" {section show=$match_list|contains( $class.identifier )}selected="selected"{/section}>{$class.name|wash}</option>
                {/section}
                </select>
                {/let}
            {/case}
            {case match=4}
                {let used_node=fetch( content, node, hash( node_path, $Parameter.value ) )}
                {section show=$used_node}
                    {$used_node.object.content_class.identifier|class_icon( small, $used_node.object.content_class.name )}&nbsp;{$used_node.object.name|wash} ({$Parameter.value})
                {section-else}
                    {$Parameter.value|wash}
                {/section}
                {/let}
                <br/>
                <input type="submit" name="BrowseButton[{$Tool.index}_parameter_{$Parameter.name}]" value="{"Browse"|i18n("design/standard/setup/toolbar")}" />
                <input type="hidden" name="{$Tool.index}_parameter_{$Parameter.name}" size="20" value="{$Parameter.value|wash}">
            {/case}
            {case match=5}
                <br/>
                {section show=array( 'true', 'false' )|contains( $Parameter.value )}
                    <input type="radio" name="{$Tool.index}_parameter_{$Parameter.name}" id="{$Tool.index}_parameter_{$Parameter.name}_true" value="true" {section show=$Parameter.value|ne( 'false' )}checked="checked"{/section} /><label for="{$Tool.index}_parameter_{$Parameter.name}_true">{'True'|i18n( 'design/standard/setup/toolbar' )}</label>
                    <input type="radio" name="{$Tool.index}_parameter_{$Parameter.name}" id="{$Tool.index}_parameter_{$Parameter.name}_false" value="false" {section show=$Parameter.value|eq( 'false' )}checked="checked"{/section} /><label for="{$Tool.index}_parameter_{$Parameter.name}_false">{'False'|i18n( 'design/standard/setup/toolbar' )}</label>
                {section-else}
                  {section show=array( 'yes', 'no' )|contains( $Parameter.value )}
                      <input type="radio" name="{$Tool.index}_parameter_{$Parameter.name}" id="{$Tool.index}_parameter_{$Parameter.name}_true" value="yes" {section show=$Parameter.value|ne( 'no' )}checked="checked"{/section} /><label for="{$Tool.index}_parameter_{$Parameter.name}_true">{'Yes'|i18n( 'design/standard/setup/toolbar' )}</label>
                      <input type="radio" name="{$Tool.index}_parameter_{$Parameter.name}" id="{$Tool.index}_parameter_{$Parameter.name}_false" value="no" {section show=$Parameter.value|eq( 'no' )}checked="checked"{/section} /><label for="{$Tool.index}_parameter_{$Parameter.name}_false">{'No'|i18n( 'design/standard/setup/toolbar' )}</label>
                  {section-else}
                      <input type="text" name="{$Tool.index}_parameter_{$Parameter.name}" size="20" value="{$Parameter.value|wash}">
                  {/section}
                {/section}
            {/case}
            {case}
                <input type="text" name="{$Tool.index}_parameter_{$Parameter.name}" size="20" value="{$Parameter.value}">
            {/case}
            {/switch}

            </td>
        </tr>
        {/section}
        </table>
    </td>
    <td>
        <input type="text" name="placement_{$Tool.index}" size="2" value="{sum($Tool.index,1)}">
    </td>
</tr>
{/section}
</table>
{/section}
<div class="buttonblock">
<input class="button" type="submit" name="UpdatePlacementButton" value="{'Update Placement'|i18n('design/standard/setup/toolbar')}" />
<input class="button" type="submit" name="RemoveButton" value="{'Remove'|i18n('design/standard/setup/toolbar')}" />
<input class="button" type="submit" name="StoreButton" value="{'Store'|i18n('design/standard/setup/toolbar')}" />
</div>

<select name="toolName">
{section var=Tool loop=$available_tool_list}
    <option value="{$Tool}">{$Tool}</option>
{/section}
</select>
<input class="button" type="submit" name="NewToolButton" value="{'Add Tool'|i18n('design/standard/setup/toolbar')}" />

</form>