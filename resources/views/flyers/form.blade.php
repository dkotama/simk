@inject('countries', 'App\Http\Utilities\Country')
  {{ csrf_field() }}
  
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="street">Street:</label>
        <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" required>
      </div>  

      <div class="form-group">
        <label for="city" class="control-label">City:</label>
        <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
      </div>    

      <div class="form-group">
        <label for="zip" class="control-label">Zip/Postal Code:</label>
        <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}" required>
      </div>
      
      <div class="form-group">
        <label for="country" class="control-label">Country:</label>
        <select name="country" id="country" class="form-control">
          @foreach ($countries::all() as $country => $code)
            <option value="{{ $code }}">{{ $country }}</option>
          @endforeach
          <option value=""></option>
        </select>
      </div>
      
      <div class="form-group">
        <label for="state" class="control-label">State:</label>
        <input type="text" name="state" id="state" class="form-control" value="{{ old('state')}}" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="price" class="control-label">Sale Price:</label>
        <input type="text" name="price" id="price" class="form-control" value="{{ old('price')}}" required>
      </div>

      <div class="form-group">
        <label for="description" class="control-label">Home Description:</label>
        <textarea name="description" id="desctiption" class="form-control" rows="10" required>{{ old('description') }}</textarea>
      </div>    
    </div>
    <div class="col-md-12">
      <hr>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Flyer</button> 
      </div>
    </div>    
  </div>


