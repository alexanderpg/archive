<table  border="0" cellpadding="0" cellspacing="10" width="100%" title="@productName@">
<tr>
	<td width="100"><A href="../shop/UID_@productUid@.html" class="style11" style="font-weight: bold;font-size:12px;" title="АРТ:@productArt@"><img src="@productImg@" alt="@productName@" border="0"  onerror="NoFoto(this,'@pathTemplate@')"></A></td>
	<td valign="middle">
	<DIV style="padding-top:10">
		<A href="../shop/UID_@productUid@.html" class="product_name" style="font-weight: bold;font-size:12px;" title="@productName@">@productName@</A>
				</DIV>
				<div style="padding-top:10">@productDes@</div>
	</td>
	<td width="100" >
	<TABLE  BORDER=0 CELLPADDING=0 CELLSPACING=0 width="100%">
	<TR>
		<TD height="21" style="background:url(../images/price_bg.gif) top left no-repeat; width:11px; padding-top:3px;padding-left:13px;" >
		<strong class=price > @productPrice@ @productValutaName@</strong><br>
		<font class=black>@productPriceRub@</font><br>
		@productSklad@
		</TD>
	</TR>
	
</TABLE>
<TABLE cellpadding="0" border="0" cellspacing="0">
							    <tr>
								   <TD >
								   @ComStartCart@
									<img hspace="5"  src="images/shop/basket_put.gif" alt="В корзину" border="0">@ComEndCart@ <!-- Блок уведомить -->
    @ComStartNotice@
    <img hspace="5" src="images/icon_email.gif" alt="" border="0" align="absmiddle">
	@ComEndNotice@
	<!-- Блок уведомить -->
									</TD>
									<TD valign="middle">@ComStartCart@<A href="javascript:AddToCart(@productUid@)" class=b  title="Купить @productName@">@productSale@</A>@ComEndCart@@ComStartNotice@<A href="/users/notice.html?productId=@productUid@" title="@productNotice@">@productNotice@</A>@ComEndNotice@
                                    </TD>
								</tr>
							</TABLE>
	</td>
</tr>
</table>
