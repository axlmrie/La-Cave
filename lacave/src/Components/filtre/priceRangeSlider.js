import React from 'react';
import ReactSlider from 'react-slider';
import '/Users/code/Documents/La-Cave/lacave/src/Styles/priceSlider.css'; // Assurez-vous d'ajouter des styles appropriés

const PriceRangeSlider = ({ minPrice, maxPrice, priceRange, setPriceRange }) => {
    return (
        <div className="price-range-slider">
            <ReactSlider
                className="horizontal-slider"
                thumbClassName="thumb"
                trackClassName="track"
                value={priceRange}
                min={minPrice}
                max={maxPrice}
                step={1}
                onChange={(values) => setPriceRange(values)}
                ariaLabel={['Lower thumb', 'Upper thumb']}
                ariaValuetext={state => `Thumb value ${state.valueNow}`}
                pearling
            />
            <div className="price-range-values">
                <span>{priceRange[0]}€</span>
                <span>{priceRange[1]}€</span>
            </div>
        </div>
    );
};

export default PriceRangeSlider;
