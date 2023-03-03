<div class="row">
    <div class="col-4">
        <div class="form-group ">
            <label for="example-text-input" class="col-md-3 col-form-label">name<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" type="text" value="{{old('name',$user ? $user->name : '')}}" id="example-text-input">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="example-text-input" class="col-md-3 col-form-label">Email<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" type="email" value="{{old('email',$user ? $user->email : '')}}" id="example-text-input" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="example-number-input" class="col-md-3 col-form-label">password<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
           
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" type="password" value="{{old('password')}}" id="example-number-input">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
           
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
                <label class="col-md-3 col-form-label">Permissions</label>
                    <div style="padding-bottom: 1px">
                        <span class="btn btn-info btn-sm btn-xs select-all" style="border-radius: 0"> Tous Sélectionner </span>
                        <span class="btn btn-info btn-sm btn-xs deselect-all" style="border-radius: 0"> Tous Deselectionner </span>
                    </div>
                    <select name="permissions[]" class="select2 form-control select2-multiple " multiple="multiple" id="e1" data-placeholder="Choisir ...">
                            @foreach ($permissions as $permission)
                                
                                <option value="{{$permission->id}}" {{ in_array($permission->id, old('permissions', [])) || ($user ? $user->permissions->contains($permission->id) : null) ? 'selected' : '' }}>{{$permission->name}}</option>
                                
                            @endforeach
                    
                    </select>
        </div>
    </div>
</div>
<div class="mt-3 float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>