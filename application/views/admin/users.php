<?php
$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Setting"            => "/setting",
        "Quản lý thành viên" => ""
    ],
    "custom_html" => '<h1> Quản lý thành viên </h1>',
];
$this->load->view('_includes/header_admin', $data_header);

?>
    <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Thêm user mới</a>
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Thêm user mới</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" id="" placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" id="" placeholder="Input field">
                        </div>
                        <div class="form-group">
                            <label for="">Thành viên</label>
                            <select name="type" class="form-control">
                                <option value="0">Khách</option>
                                <option value="0">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($rs as $key => $value) {
            ?>
            <tr>
                <td><?=$value->username;?></td>
                <td><?=$value->password;?></td>
                <td><a class="btn btn-info" href="/admin/users/change_password/<?=$value->id;?>">Change password</a>
                </td>
                <td><a class="btn btn-info" href="/admin/users/change_setting/<?=$value->id;?>">Change setting</a></td>
                <td><?=$value->type;?></td>
            </tr>
            <?php
        } ?>

        </tbody>
    </table>
<?php $this->load->view('_includes/footer_admin'); ?>