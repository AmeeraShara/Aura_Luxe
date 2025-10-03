<style>
    /* Desktop Styles */
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .filter-icon span {
        font-weight: bold;
        font-size: 1.1rem;
        margin-right: 0.5rem;
    }

    .filter-section {
        display: flex;
        flex-direction: column;
    }

    .d-flex {
        display: flex;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .flex-column {
        flex-direction: column;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .mt-1 {
        margin-top: 0.5rem;
    }

    .hidden-radio {
        display: none;
    }

    .size-button {
        padding: 0.3rem 0.6rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
        user-select: none;
    }

    .size-button.active {
        background-color: #333;
        color: #fff;
    }

    .color-box {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 1px solid #ccc;
        display: inline-block;
        cursor: pointer;
    }

    /* New: Color filter grid with 6 columns */
    .color-filter {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 0.5rem;
    }

    /* Responsive Styles for Mobile */
    @media (max-width: 768px) {
        .filter-bar {
            flex-direction: column;
            gap: 1rem;
        }

        .filter-icon span {
            display: block;
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }

        .filter-section {
            gap: 0.5rem;
        }

        .d-flex {
            flex-direction: row;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .size-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }

        .color-box {
            width: 25px;
            height: 15x;
        }
    }
</style>

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

    <div class="filter-section color-filter">
        @foreach($availableColors as $basicColor => $previewHex)
        <label>
            <input type="radio" name="color" value="{{ $basicColor }}" class="hidden-radio filter-input"
                {{ request('color') === $basicColor ? 'checked' : '' }}>
            <span class="color-box" title="<?php echo $basicColor; ?>" style="<?php echo 'background-color:' . $previewHex . ';'; ?>" data-color="<?php echo $basicColor; ?>"> </span>
        </label>
        @endforeach
    </div>
</div>