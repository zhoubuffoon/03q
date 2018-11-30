<?php if (!defined('THINK_PATH')) exit();?>    <form action="<?php echo U('index/index');?>" method="get">
    	商品名称：<input type="text" name="name" value="<?php echo I('name');?>">
    	商品编码：<input type="text" name="num" value="<?php echo I('num');?>">
    	商品库存：<select name="count">
    		<option value="0">所有</option>
    		<option value="1" <?php if(I('count')==1){ echo "selected='selected'"; }?>  >>1</option>
    		<option value="10" <?php if(I('count')==10){ echo "selected='selected'"; }?>  >>10</option>
    		<option value="20" <?php if(I('count')==20){ echo "selected='selected'"; }?>  >>20</option>
    	</select>
    	<input type="submit" value="搜索">
    </form>
    
   <!-- 欢迎您，帅气的顾客:不做大哥好多年</br>
   去添加一个商品吧 <a href="add.php">添加商品</a> -->
    <table border='1'>
    <tr>
    <td><input type="checkbox" ></td>
    <td><a href="<?php echo U('index/index',array('type'=>'id','order'=>'asc'));?>">商品ID</a></td>
    <td>商品名称</td>
    <td>商品编码</td>
    <td>商品价格</td>
    <td>商品库存</td>
    <td>商品图片</td>
    <td><a href="<?php echo U('index/index',array('type'=>'createtime','order'=>'desc'));?>">创建时间</a></td>
    <td>操作</td>
    </tr>
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
        	<td><input type="checkbox" ></td>
		    <td><?php echo ($vo['id']); ?></td>
		    <td><?php echo ($vo['goods_name']); ?></td>
		    <td><?php echo ($vo['goods_num']); ?></td>
		    <td><?php echo ($vo['goods_price']); ?></td>
		    <td><?php echo ($vo['goods_count']); ?></td>
		    <td><img src="http://localhost/tp3/Uploads/<?php echo ($vo['file']); ?>" width="100px" height="100px" /></td>
		    <td><?php echo (date("Y-m-d H:i:s",$vo['createtime'])); ?></td>
		    <td><a href="<?php echo U('index/add?id='.$vo['id']);?>">修改</a>&nbsp;&nbsp;<a href="<?php echo U('index/del?id='.$vo['id']);?>">删除</a></td>
   		</tr><?php endforeach; endif; ?>
    <tr>
    	<td><input type="button" value="批量删除"></td>
    </tr>
  </table>
    <?php echo ($page); ?>