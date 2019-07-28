<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 0:00
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

$customers = new customers();

?>


<div class="module">
    <h4>Clientes</h4><a class="modal-trigger waves-effect waves-tomato btn-floating btn-small" href="#modal1"><i class="large material-icons tomato">add</i></a>
    <div id="modal1" class="modal">

    </div>
    <table class="striped">
        <thead>
        <tr>
            <th data-field="id">Nombre Completo</th>
            <th data-field="name">Teléfono</th>
            <th data-field="name">Correo</th>
            <th data-field="price">Ciudad</th>
            <th data-field="price">NIF</th>
            <th data-field="price">Acciones</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($customers->getCustomers() as $customer){
            ?>
            <tr customer="<?php echo $customer["id"] ?>">
                <td name="fullName"><?php echo $customer["fullName"]; ?></td>
                <td><?php echo $customer["phone"]; ?></td>
                <td><?php echo $customer["mail"]; ?></td>
                <td><?php echo $customer["city"]; ?></td>
                <td><?php echo $customer["nif"]; ?></td>
                <td><i customer="<?php echo $customer["id"] ?>" onclick="editCustomer(this)" class="large material-icons customerIcon">edit</i><i customer="<?php echo $customer["id"] ?>" onclick="modalDeleteUser(this)" class="large material-icons customerIcon">delete</i><i class="large material-icons customerIcon">description</i></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
