<div>
    <hr class="h-color mx-2 mt-3">
    <label for="compfunctiondesc" class="inline-block fs-6 mb-2" >
        What function do you feel competent to perform?<span class="text-danger fw-bold">*</span><br>
        <label class="fw-bold">(Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
    </label><br>
    
    <div class="d-grid gap-3 mt-3">
        <table>
            <tr>
                <td>
                    <select wire:model="compfunction0" id="compfunctiondesc" class="border border-3 border-dark rounded-3" style="width: 90%">
                        <option value="">-Select One Competency-</option>
                        @foreach ($comps as $key => $comp)
                        <optgroup label={{$key}}>
                            @foreach ($comp as $item)
                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                            @endforeach
                        @endforeach
                    </select>
                    @error('compfunction0') <span class="text-danger">{{ $message }}</span> @enderror
                </td>
                <td>
                    <select wire:model="compfunction1" id="compfunctiondesc" class="border border-3 border-dark rounded-3 ms-3" style="width: 90%">
                        <option value="">-Select One Competency-</option>
                        @foreach ($comps as $key => $comp)
                        <optgroup label={{$key}}>
                            @foreach ($comp as $item)
                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                            @endforeach
                        @endforeach
    
                    </select>
                    @error('compfunction1') <span class="text-danger">{{ $message }}</span> @enderror
                </td>
            </tr>
          
            <tr>
                <td>
                    <textarea class="border border-3 border-dark rounded-3 mt-3 me-3" style="width: 90%" rows="4" cols="85" wire:model="compfunctiondesc0" id="compfunctiondesc">{{old('compfunctiondesc0')}}</textarea>
    
                    @error('compfunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                </td>
                
                <td>
                    <textarea  class="border border-3 border-dark rounded-3 mt-3 ms-3" style="width: 90%"  rows="4" cols="85" wire:model="compfunctiondesc1" id="compfunctiondesc">{{old('compfunctiondesc1')}}</textarea>
    
                    @error('compfunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                </td>
            </tr>
       
        </table>
    </div>

    
</div>
<hr class="h-color mx-2 mt-3">
<div>
    <label for="diffunctiondesc" class="inline-block fs-6 mb-2">
        What function do you have a difficulty to perform?<span class="text-danger fw-bold">*</span><br>
        <label class="fw-bold">(Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)                                
    </label><br>
    <div class="d-grid mt-3">
    <table>
        <tr>
            <td>
                <select wire:model="diffunction0" id="diffunctiondesc" class="border border-3 border-dark rounded-3" style="width: 90%">
                    <option value="">-Select One Competency-</option>
                    @foreach ($comps as $key => $comp)
                    <optgroup label={{$key}}>
                        @foreach ($comp as $item)
                        <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                        @endforeach
                    @endforeach

                </select>
                @error('diffunction0') <span class="text-danger">{{ $message }}</span> @enderror
            </td>
            <td>
                <select wire:model="diffunction1" id="diffunctiondesc" class="border border-3 border-dark rounded-3 ms-3" style="width: 90%">
                    <option value="">-Select One Competency-</option>
                    @foreach ($comps as $key => $comp)
                    <optgroup label={{$key}}>
                        @foreach ($comp as $item)
                        <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                        @endforeach
                    @endforeach

                </select>
                @error('diffunction1') <span class="text-danger">{{ $message }}</span> @enderror
            </td>
        </tr>
        <tr>
            <td>
                <textarea class="border border-3 border-dark rounded-3 mt-3 me-3" style="width: 90%" rows="4" cols="85" wire:model="diffunctiondesc0" id="diffunctiondesc"></textarea>

                @error('diffunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
            </td>
            <td>
                <textarea class="border border-3 border-dark rounded-3 mt-3 ms-3" style="width: 90%" rows="4" cols="85" wire:model="diffunctiondesc1" id="diffunctiondesc"></textarea>

                @error('diffunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
            </td>
        </tr>
    </table>
    </div>
</div>
<hr class="h-color mx-2 mt-3">
<div>
    <p class="inline-block fs-6 mb-2">
        Where do you see your career progressing in? the next two years?<span class="text-danger fw-bold">*</span>
    </p>
    <div class="d-grid">
    <table>
        <tr>
            <td>
                <textarea class="border border-3 border-dark rounded-3" style="width: 97%" rows="10" cols="70" wire:model="career">{{old('career')}}</textarea>

                @error('career') <span class="text-danger">{{ $message }}</span> @enderror
            </td>
        </tr>
    </table>
    </div>
</div>