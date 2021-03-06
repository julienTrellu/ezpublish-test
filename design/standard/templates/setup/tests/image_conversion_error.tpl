{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<h3>{$result_number}. {"Missing image conversion support"|i18n("design/standard/setup/tests")}</h3>

<p>
 {"No image conversion capabilities was detected, this means that eZ Publish cannot scale any images or detect their type. This is vital functionality in eZ Publish and must be supported."|i18n("design/standard/setup/tests")}
</p>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
{section name=Test loop=$test_result[2].test_results}
{section-exclude match=$:item[0]|ne(2)}
<tr>
  <td>{include uri=concat('design:setup/tests/',$:item[1],'_error.tpl') test_result=$:item result_number=concat($result_number,'.',$:number)}</td>
</tr>

{delimiter}
<tr><td>&nbsp;</td></tr>
{/delimiter}
{/section}
</table>
