@extends('common.admin_base')

@section('title','管理后台-文章编辑')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 文章编辑 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('msg') }}
        </div>
    @endif
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>

            <h4 class="panel-title">文章编辑表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/article/save" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$info->id}}">
                <input type="hidden" name="admin_id" value="{{$user_id}}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">文章分类</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="cate_id">
                            @if(!empty($category))
                                @foreach($category as $cate)
                                 <option value="{{$cate['id']}}" @if($info->cate_id == $cate['id']) selected @endif>{{$cate['cate_name']}}</option>
                                 @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">文章标题</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="文章标题" class="form-control" name="title" value="{{$info->title}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">发布时间</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="发布时间" class="form-control" id="publish_at" name="publish_at" value="{{$info->publish_at}}" />
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-3 control-label">文章点击数</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="文章点击数" class="form-control" name="clicks" value="{{$info->clicks}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">状态</label>
                    <div class="col-sm-6">
                        <div class="radio"><label><input type="radio" name="status" value="1" @if($info->status == 1 ) checked @endif> 待审核</label></div>
                        <div class="radio"><label><input type="radio" name="status" value="2" @if($info->status == 2 ) checked @endif>审核</label></div>
                        <div class="radio"><label><input type="radio" name="status" value="3" @if($info->status == 3 ) checked @endif>已发布</label></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">文章描述</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" rows="3" name="description">{{$info->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">文章描述</label>
                    <div class="col-sm-9">
                        <textarea rows="6" name="content" id="content">{{$content->content}}</textarea>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存文章</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>

        </div><!-- panel-body -->
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="/js/ueditor/ueditor.all.js"></script>
        <script type="text/javascript">

            $(".alert-danger").hide();

            $("#btn-save").click(function(){
                var brand_name = $("input[name=cate_name]").val();

                if(brand_name == ''){
                    $("#error_msg").text('品牌名称不能为空');
                    $(".alert-danger").toggle();
                    return false;
                }

            });

            var ue = UE.getEditor('content');

            //开始日期
            $("#publish_at").datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                minView: 0,
                language:  'zh-CN',
                minuteStep:1
            });
        </script>

@endsection