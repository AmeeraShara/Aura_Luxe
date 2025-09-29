
<div class="filter-bar">
    <div class="filter-icon"><span>Size:</span></div>

    <!-- Sizes -->
    <div class="filter-section flex-column">
        <div class="d-flex flex-wrap gap-2">
                     @foreach(['XS','S','M','L'] as $size)
                <label>
                    <input type="radio" name="size" value="{{ $size }}" class="hidden-radio filter-input"
                        {{ request('size') === $size ? 'checked' : '' }}>
                    <span class="size-button {{ request('size') === $size ? 'active' : '' }}">{{ $size }}</span>
                </label>
            @endforeach
        </div>
        <div class="d-flex flex-wrap gap-2 mt-1">
            @foreach(['XL','XXL','XXXL'] as $size)
                <label>
                    <input type="radio" name="size" value="{{ $size }}" class="hidden-radio filter-input"
                        {{ request('size') === $size ? 'checked' : '' }}>
                    <span class="size-button {{ request('size') === $size ? 'active' : '' }}">{{ $size }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Colors -->
         <div class="filter-icon"><span>Color:</span></div>

    <div class="filter-section">
        @foreach($availableColors as $basicColor => $previewHex)
            <label>
                <input type="radio" name="color" value="{{ $basicColor }}" class="hidden-radio filter-input"
                    {{ request('color') === $basicColor ? 'checked' : '' }}>
                    <span class="color-box"
                        title="<?php echo $basicColor; ?>"
                        style="<?php echo 'background-color:' . $previewHex . ';'; ?>"
                        data-color="<?php echo $basicColor; ?>">
                    </span>
            </label>
        @endforeach
    </div>

    <!-- Reset -->

</div>
