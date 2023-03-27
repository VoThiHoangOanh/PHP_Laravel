<div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                 <label for="names">Tên thuộc tính</label> 
                 <input type="text" name="names" value="{{old('names')}}" id="names" class="form-control"
                  placeholder="Nhập tên sản phẩm">
                  @if($errors->has('names'))
                  <div class="text-danger">
                    {{$errors->first('names')}}
                  </div>
                  @endif
                </div>

                <div class="mb-3">
                 <label for="metadescs">Mô tả</label>
                 <textarea name="metadescs" id="metadescs" class="form-control"
                  placeholder="Nhập mô tả">{{old('metadescs')}}</textarea> 
                  @if($errors->has('metadescs'))
                  <div class="text-danger">
                    {{$errors->first('metadescs')}}
                  </div>
                  @endif
                </div>


              </div>
              <div class="col-md-6">
              <div class="mb-3">
                 <label for="names">Giá trị</label> 
                 <input type="text" name="names" value="{{old('names')}}" id="names" class="form-control"
                  placeholder="Nhập tên sản phẩm">
                  @if($errors->has('names'))
                  <div class="text-danger">
                    {{$errors->first('names')}}
                  </div>
                  @endif
                </div>

                <div class="mb-3">
                 <label for="metadescs">Vị Trí</label>
                 <textarea name="metadescs" id="metadescs" class="form-control"
                  placeholder="Nhập mô tả">{{old('metadescs')}}</textarea> 
                  @if($errors->has('metadescs'))
                  <div class="text-danger">
                    {{$errors->first('metadescs')}}
                  </div>
                  @endif
                </div>

              </div>

            </div>