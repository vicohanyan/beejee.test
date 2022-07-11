<title>ToDo List</title>

<div class="container">
    <div class="row">
        <h1>Todo list</h1>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>User name</th>
                <th>Description</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['tasks'] as $task): ?>
                <tr>
                    <td><?= $task->getId(); ?></td>
                    <td><?= $task->getEmail(); ?></td>
                    <td><?= $task->getUsername(); ?></td>
                    <td><?= $task->getDescription(); ?></td>
                    <td>
                        <?php if($task->getstatus() == 0):  ?>
                            <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <?php else:  ?>
                            <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <?php endif;  ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if($data['pageCount'] > 1):?>
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif;?>
                    <?php for($i = 1; $i<=$data['pageCount'];$i++):?>
                    <li><a href="/main/index?page="<?=$i?>><?=$i?></a></li>
                    <?php endfor;?>
                    <?php if($data['page'] < $data['pageCount']):?>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
    </div>
</div>
