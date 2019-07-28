<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 28/07/2019
 * Time: 2:20
 */
require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

//var_dump($_GET);

$invoices = new invoices();
$dataInv = $invoices->getInvoice($_GET["invoice"],$_SESSION["id"])[0];
//guay($dataInv);

use Spipu\Html2Pdf\Html2Pdf;
ob_start();
?>
    <style type="text/css">
        <!--
        table {width: 100%;}
        table.page_header{
            border-bottom: solid 0.2mm #d8d8d8;padding-bottom: 2mm
        }
        h1 {color: #000033}
        h2 {color: #000055}
        h3 {color: #000077}
        p{margin: 0.6mm;}
        div.standard
        {
            padding-left: 5mm;
        }
        tr{

        }
        -->
    </style>
    <page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
        <table>
            <tr>
                <td style="width: 50%;padding-left: 20px; text-align: left">

                    <p class="s12">Factura Nº <?php echo $dataInv["number"];?></p>
                    <p class="s12">Fecha Factura <?php echo $dataInv["date"];?></p>
                    <p class="s12">Fecha de vencimiento <?php echo $dataInv["date"];?></p>
                </td>
            </tr>
        </table>
        <table style="margin-top: 15mm">
            <tr>
                <td style="width: 50%; text-align: left">
                    <p class="col s12"><b><?php echo $dataInv["user"]["fullName"];?></b></p>
                    <p class="col s12"><?php echo $dataInv["user"]["address"];?></p>
                    <p class="col s12"><?php echo $dataInv["user"]["cp"];?> - <?php echo $dataInv["user"]["city"];?></p>
                    <p class="col s12"><?php echo $dataInv["user"]["country"];?></p>
                    <p class="col s12"><?php echo $dataInv["user"]["nif"];?></p>
                </td>
                <td style="width: 50%;padding-left: 20px; text-align: left">
                    <p class="col s12"><b> <?php echo $dataInv["customer"]["customer"];?></b></p>
                    <p class="col s12"> <?php echo $dataInv["customer"]["address"];?></p>
                    <p class="col s12"> <?php echo $dataInv["customer"]["cp"];?> -  <?php echo $dataInv["customer"]["city"];?></p>
                    <p class="col s12"> <?php echo $dataInv["customer"]["country"];?></p>
                    <p class="col s12"> <?php echo $dataInv["customer"]["nif"];?></p>
                </td>
            </tr>
        </table>
        <table class="page_header" style="margin-top: 15mm">
            <tr style="border-bottom: solid 1mm #AAAADD;">
                <td style="width: 15%; margin-bottom: 2mm"><b>Cantidad</b></td>
                <td style="width: 45%"><b>Descripción</b></td>
                <td style="width: 20%"><b>Precio</b></td>
                <td style="width: 20%"><b>Total</b></td>
            </tr>
        </table>
        <?php
        foreach($dataInv["details"] as $detail){
            ?>
            <table style="margin-top: 2mm">
                <tr style="border-bottom: solid 1mm #AAAADD">
                    <td style="width: 15%;padding: 1mm"><?php echo $detail["quantity"]?></td>
                    <td style="width: 45%;padding: 1mm"><?php echo $detail["detail"]?></td>
                    <td style="width: 20%;padding: 1mm"><?php echo $detail["price"]?></td>
                    <td style="width: 20%;padding: 1mm"><?php echo floatval($detail["price"]) * floatval($detail["quantity"])?></td>
                </tr>
            </table>

            <?php
        }
        ?>
        <table style="margin-top: 15mm">
            <tr>
                <td style="width: 60%"></td>
                <td style="width: 20%">Total Imp. Excl.</td>
                <td style="width: 20%"> <?php echo $dataInv["total"] - $dataInv["rate"];?> €</td>
            </tr>
        </table>
        <table style="margin-top: 2mm">
            <tr>
                <td style="width: 60%"></td>
                <td style="width: 20%">IVA</td>
                <td style="width: 20%; text-align: left"><?php echo $dataInv["rate"];?> €</td>
            </tr>
        </table>
        <table style="margin-top: 2mm">
            <tr>
                <td style="width: 60%"></td>
                <td style="width: 20%">Total Factura</td>
                <td style="width: 20%; text-align: left"><?php echo $dataInv["total"];?> €</td>
            </tr>
        </table>
        <table style="margin-top: 12mm">
            <tr>
                <td style="width: 100%; text-align: left"><b>Comentarios</b></td>
            </tr>
        </table>
        <table style="margin-top: 2mm">
            <tr>
                <td style="width: 100%; text-align: left"><?php echo $dataInv["comment"];?> </td>
            </tr>
        </table>
    </page>

<?php
$html = ob_get_clean();

$mipdf = new Html2Pdf("P","A4","es","true","UTF-8");

$mipdf->writeHTML($html);
$mipdf->output($dataInv["number"].".pdf",'D');
