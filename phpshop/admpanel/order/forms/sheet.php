<?php
session_start();
$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass(array("base", "order", "system", "inwords", "delivery", "date", "valuta", "lang"));

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
if (!isset($_GET['massprint'])) {
    $PHPShopBase->chekAdmin();
}

$PHPShopSystem = new PHPShopSystem();
$LoadItems['System'] = $PHPShopSystem->getArray();
$PHPShopLang = new PHPShopLang(array('locale' => $_SESSION['lang'], 'path' => 'admin'));

// Подключаем реквизиты
$SysValue['bank'] = unserialize($LoadItems['System']['bank']);
// Номер заказа, наименование, артикул, кол-во (для сборки)
$sql = "select * from " . $SysValue['base']['table_name1'] . " where id IN(" . $_GET['orderID'] . ")";

$n = 1;
$result = mysqli_query($link_db, $sql);
$dis = $sum = $num = null;
while ($row = mysqli_fetch_array($result)) {

    if(!in_array($row['statusi'],[146,151,149,144]))
     continue;

    $order = unserialize($row['orders']);
    $status = unserialize($row['status']);

    $n = 1;

    if ($order['Cart']['num'] == 1) {
        foreach ($order['Cart']['cart'] as $val) {

            /*
              if ($n > 1) {
              $row['uid'] = $status['comment_maneger'] = $row['fio'] = null;
              }

              $dis .= "
              <tr class=tablerow>
              <td class=tablerow>" . $row['uid'] . "</td>
              <td class=tablerow>" . $row['fio'] . "</td>
              <td class=tablerow>" . $val['name'] . "</td>
              <td class=tablerow nowrap>" . $val['uid'] . "</td>
              <td class=tablerow>" . $val['num'] . "</td>
              <td class=tablerow>" . $status['comment_maneger'] . "</td>
              <td class=tableright> </td>
              </tr>";
              $n++; */



            $sheet[$val['category']][$row['id']][] = [
                'id' => $row['uid'],
                'fio' => $row['fio'],
                'name' => $val['name'],
                'uid' => $val['uid'],
                'num' => $val['num'],
                'comment_maneger' => $status['comment_maneger']
            ];
        }
    } else {
        foreach ($order['Cart']['cart'] as $val) {

            $sheet[0][$row['id']][] = [
                'id' => $row['uid'],
                'fio' => $row['fio'],
                'name' => $val['name'],
                'uid' => $val['uid'],
                'num' => $val['num'],
                'comment_maneger' => $status['comment_maneger']
            ];
        }
    }
}

foreach ($sheet as $data) {
    foreach ($data as $rows) {

        foreach ($rows as $n => $row) {

            if ($n > 0) {
                $row['id'] = $row['comment_maneger'] = $row['fio'] = null;
            }

            $dis .= "<tr class=tablerow>
		<td class=tablerow>" . $row['id'] . "</td>
                <td class=tablerow>" . $row['fio'] . "</td>
		<td class=tablerow>" . $row['name'] . "</td>
		<td class=tablerow nowrap>" . $row['uid'] . "</td>
		<td class=tablerow>" . $row['num'] . "</td>
		<td class=tablerow>" . $row['comment_maneger'] . "</td>
		<td class=tableright></td>
	     </tr>";
        }
    }
}


if ($LoadItems['System']['nds_enabled']) {
    $nds = $LoadItems['System']['nds'];
    $nds = number_format($sum * $nds / (100 + $nds), "2", ".", "");
}
$sum = number_format($sum, "2", ".", "");

$name_person = $order['Person']['name_person'];
$org_name = $order['Person']['org_name'];
$datas = PHPShopDate::dataV($datas, false);

// Генерим номер товарного чека
$chek_num = substr(abs(crc32(uniqid(rand(), true))), 0, 5);
$LoadBanc = unserialize($LoadItems['System']['bank']);
?>
<!doctype html>
<head>
    <title><?php echo __("Сборный лист"); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <script src="../../../lib/templates/print/js/html2pdf.bundle.min.js"></script>
</head>
<body>
    <?php
    if (!isset($_GET['massprint'])) {
        $btn = "html2pdf(document.getElementById('content'), {margin: 1, filename: 'СборныйЛист.№" . $chek_num . ".pdf', html2canvas: {dpi: 192, letterRendering: true}})";
        echo
        '<div align="right" class="nonprint">
                <button onclick="' . $btn . '">Сохранить</button>
    <button onclick="window.print();">Распечатать</button>
    <hr>
    </div>';
    }
    ?>
    <div id="content">
        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
                <TR>
                    <TH scope=row align=middle width="50%" rowSpan=3><img src="<?php echo $PHPShopSystem->getLogo(); ?>" alt="" border="0" style="max-width: 200px;height: auto;"></TH>
                    <TD align=right>
                        <BLOCKQUOTE>
                            <P><b><?php _e("Сборный лист") ?></b> <SPAN class=style4>№<?php echo @$chek_num ?> - <?php echo $datas ?></SPAN> </P></BLOCKQUOTE></TD></TR>
                <TR>
                    <TD align=right>
                        <BLOCKQUOTE>
                            <P><SPAN class=style4><?php echo $LoadBanc['org_adres'] ?>, <?
    _e("телефон");
    echo " " . $LoadItems['System']['tel']
    ?> </SPAN></P></BLOCKQUOTE></TD></TR>
            </TBODY></TABLE>

        <p><br></p>
        <table width=99% cellpadding=2 cellspacing=0 align=center>
            <tr class=tablerow>
                <td class=tablerow><?php _e("№ Заказа") ?></td>
                <td class=tablerow><?php _e("ФИО") ?></td>
                <td class=tablerow><?php _e("Наименование") ?></td>
                <td class=tablerow><?php _e("Артикул") ?></td>
                <td class=tablerow ><?php _e("Кол-во") ?></td>
                <td class=tablerow ><?php _e("Комментарий") ?></td>
                <td class=tablerow style="border-right: 1px solid #000000;">&nbsp;&nbsp;&nbsp;</td>


            </tr>
            <?php echo $dis; ?>
            <tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
        </table>

        <table>
            <tr>
                <td><b><?php _e("Продавец") ?>:</b></td>
                <td><?php
            echo '<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>';
            ?></td>
                <td width="150"></td>
                <td >

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    echo '<div style="padding:50px;border-bottom: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center">М.П.</div>';
                    ?>
                </td>
            </tr>
        </table>

    </div>
    <style>
        body {
            text-decoration: none;
            font: normal 11px Verdana, Arial, Helvetica, sans-serif;
            text-transform: none;
        }

        p {
            word-spacing: normal;
            white-space: normal;
            margin: 5px 5px 5px 5px;
            letter-spacing : normal;
        }
        TD {
            font: normal 11px Verdana, Arial, Helvetica, sans-serif;
            background: #FFFFFF;
            padding:2px;
        }
        H4 {
            font: Verdana, Arial, Helvetica, sans-serif;
            background: #FFFFFF;
        }
        .tablerow {
            border: 0px;
            border-top: 1px solid #000000;
            border-left: 1px solid #000000;
        }
        .tableright {
            border: 0px;
            border-top: 1px solid #000000;
            border-left: 1px solid #000000;
            border-right: 1px solid #000000;
            text-align: right;
        }
        #d1 {
            display: inline;
            float: right;
            width: 600px;
            font-size: 10px;
            margin-top: 100px;
            margin-bottom: 10px;
        }

        #d2 {
            font-size:18px;
            text-transform:uppercase;
            font-weight: bold;

        }

        #d3 {
            font-size:10px;

        }

        #center{
            text-align: center;
        }

        input {
            box-shadow: none;
            border-color: transparent;
            background-color: transparent;
            width: 300px;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
        }
        @media print{
            .nonprint {
                display: none;
            }
        }
    </style>
</body>
</html>
