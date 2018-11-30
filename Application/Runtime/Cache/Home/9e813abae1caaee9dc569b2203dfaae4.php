<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Index/add');?>" method="post" enctype="multipart/form-data">
商品名称：<input type="text" name="goods_name" value="<?php echo ($info['goods_name']); ?>" /><br>
商品编号：<input type="text" name="goods_num" value="<?php echo ($info['goods_num']); ?>"  /><br>
商品价格：<input type="text" name="goods_price" value="<?php echo ($info['goods_price']); ?>" /><br>
库存：<input type="text" name="count"  value="<?php echo ($info['goods_count']); ?>" /><br>
商品图片：<input type="file" name="file"  /><br>
<img src="http://localhost/tp3/Uploads/<?php echo ($info['file']); ?>"><br>
<!-- <div class="">
<label for="j_verify" class="t">验证码：</label> 
<input id="j_verify" name="j_verify" type="text" class="form-control x164 in">
<img id="verify_img" alt="点击更换" title="点击更换" src="<?php echo U('index/verify',array());?>" class="m">
</div> -->
<input type="submit" value="提交"/>
</form>