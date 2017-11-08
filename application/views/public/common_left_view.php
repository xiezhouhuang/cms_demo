
<div class="layui-col-sm3  like-table">
          <img src="<?php echo $_globals_banner['banner_1'] ?>" width="100%">
          <br />
          <table class="layui-table">
            <thead>
              <tr>
                <th colspan="3" align="left" style="background: #000;color: #FFF">昨日战绩 <a href="/home/history" style="float: right;color: #FFF">更多>></a></th>
              </tr> 
            </thead>
            <tbody>
             <?php foreach ($get_yesterday_data as $key => $value): ?>
              <tr>
                <td class="like-table">
                <table class="layui-table layui-table-center layui-table-no-padding" lay-skin="nob">
                  <tbody><tr><td rowspan="2">
                  <span class="layui-badge-rim 
                  <?php if ($value['category_id'] == 3): ?>
                    layui-bg-red 
                  <?php else: ?>
                    layui-bg-gray
                  <?php endif ?>">
                  <?php echo $_globals_bisai_category[$value['category_id']] ?>
                  </span>
                  </td>
                  <td><?php echo $value['zhudui'] ?></td><td>VS</td><td><?php echo $value['kedui'] ?></td></tr>
                  <tr><td colspan="3"><?php echo $value['daan'] ?><?php echo $value['pankou'] ?></td></tr></tbody>
                </table>
                </td>
                <td>
                  <?php if ($value['status'] == 2): ?>
                    <span class="layui-color-gray">错</span>
                  <?php else: ?>
                    <span class="layui-color-red">中</span>
                  <?php endif ?>
                </td>
                <td><button class="layui-btn layui-btn-mini  layui-bg-red"><a class="layui-bg-red" href="/home/product_detail/<?php echo $value['product_id'] ?>">查看</a></button></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
          <?php echo $get_left_table1; ?>
           <?php echo $get_left_table2; ?>
          <img src="<?php echo $_globals_banner['banner_2'] ?>" width="100%">
          <br />
          <br />
      </div>