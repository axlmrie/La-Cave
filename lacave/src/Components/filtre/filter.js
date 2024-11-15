import '../../Styles/filter.css'
import Categories from './Categories';
import { plantList, creaVinList } from '../../Datas/plantList';
import { useState, useEffect } from 'react';
import Conditionnement from './conditionnement';
import Famille from './famille';
import Annee from './annee';
import PriceRangeSlider from './priceRangeSlider';

const Filter = ({ setActiveCategory ,
     activeCategory,
     setActiveConditionnement,
     activeConditionnement,
     setActiveFamille,
     activeFamille,
    setActiveAnnee,
    activeAnnee,
    setPriceRange,
    priceRange}) => {
    const [plants, setPlants] = useState([]);
    
    useEffect(() => {
        const fetchData = async () => {
            await creaVinList();
            setPlants([...plantList]);
        };
        fetchData();
    }, []);

    

    const categories = plants.reduce(
        (acc, plant) =>
            acc.includes(plant.category) ? acc : acc.concat(plant.category),
        []
    );
    const conditionnement = plants.reduce(
        (acc, plant) =>
            acc.includes(plant.conditionnement) ? acc : acc.concat(plant.conditionnement),
        []
    );

    const famille = plants.reduce(
        (acc, plant) =>
            acc.includes(plant.vignoble) ? acc : acc.concat(plant.vignoble),
        []
    );

    const annee = plants.reduce(
        (acc, plant) =>
            acc.includes(plant.annee) ? acc : acc.concat(plant.annee),
        []
    );
     const minPrice = Math.min(...plants.map(plant => plant.price));
    const maxPrice = Math.max(...plants.map(plant => plant.price));

    return (
        <div className='filtre'>
            <h1>Filtre</h1>
            <Categories
                categories={categories}
                setActiveCategory={setActiveCategory}
                activeCategory={activeCategory}
            />
            <Conditionnement
            conditionnement={conditionnement}
            setActiveConditionnement={setActiveConditionnement}
            activeConditionnement={activeConditionnement}
            />
            <Famille
            famille={famille}
            setActiveFamille={setActiveFamille}
            activeFamille={activeFamille}
            />

            <Annee
            annee={annee}
            setActiveAnnee={setActiveAnnee}
            activeAnnee={activeAnnee}
            />

            <PriceRangeSlider
                minPrice={minPrice}
                maxPrice={maxPrice}
                priceRange={priceRange}
                setPriceRange={setPriceRange}
            />
            <button onClick={()=> {setActiveCategory('') ;setActiveAnnee('');setActiveConditionnement('');setActiveFamille('');}}>Réintialiser</button>
        </div>
    );
};

export default Filter;
