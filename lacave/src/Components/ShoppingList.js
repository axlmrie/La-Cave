import { useState, useEffect } from 'react';
import { plantList, creaVinList } from '../Datas/plantList';
import '../Styles/ShoppingList.css';
import PlantItem from './PlantItem';

function ShoppingList({ cart, updateCart, activeCategory, setActiveCategory, activeConditionnement, setActiveConditionnement, activeFamille, setActiveFamille, activeAnnee, setActiveAnnee, priceRange, setPriceRange }) {
    const [plants, setPlants] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 20;

    console.log(plants)

    useEffect(() => {
        const fetchData = async () => {
            try {
                await creaVinList();
                setPlants([...plantList]);
                setLoading(false);
            } catch (error) {
                setError("Erreur lors du chargement des données.");
                setLoading(false);
            }
        };
        fetchData();
    }, []);

    useEffect(() => {
        // Remettre currentPage à 1 lorsque l'un des filtres change
        setCurrentPage(1);
    }, [activeCategory, activeConditionnement, activeFamille, activeAnnee, priceRange]);

    function addToCart(name, price, id, idFournisseur) {
        const currentPlantSaved = cart.find((plant) => plant.name === name);
        if (currentPlantSaved) {
            const cartFilteredCurrentPlant = cart.filter(
                (plant) => plant.name !== name
            );
            updateCart([
                ...cartFilteredCurrentPlant,
                { name, price,id,idFournisseur, amount: currentPlantSaved.amount + 1 }
            ]);
        } else {
            updateCart([...cart, { name, price,id,idFournisseur, amount: 1 }]);
        }
    }

    // Filtrer les plantes en fonction des filtres actifs
    const filteredPlants = plants.filter((plant) => {
        return (
            (!activeCategory || plant.category === activeCategory) &&
            (!activeConditionnement || plant.conditionnement === activeConditionnement) &&
            (!activeFamille || plant.vignoble === activeFamille) &&
            (!activeAnnee || plant.annee === activeAnnee) &&
            plant.price >= priceRange[0] && plant.price <= priceRange[1]
        );
    });

    // Calculer la pagination
    const totalPages = Math.ceil(filteredPlants.length / itemsPerPage);
    const indexOfLastPlant = currentPage * itemsPerPage;
    const indexOfFirstPlant = indexOfLastPlant - itemsPerPage;
    const currentPlants = filteredPlants.slice(indexOfFirstPlant, indexOfLastPlant);

    const handlePreviousPage = () => {
        if (currentPage > 1) {
            setCurrentPage(currentPage - 1);
        }
    };

    const handleNextPage = () => {
        if (currentPage < totalPages) {
            setCurrentPage(currentPage + 1);
        }
    };

    if (loading) {
        return <div>Chargement...</div>;
    }

    if (error) {
        return <div>{error}</div>;
    }

    return (
        <div className='lmj-shopping-list'>
            <div className='filterOnDiv'>
                {activeCategory && (
                    <div className='filterOn'>
                        {activeCategory}
                        <div onClick={() => setActiveCategory('')}>×</div>
                    </div>
                )}
                {activeAnnee && (
                    <div className='filterOn'>
                        {activeAnnee}
                        <div onClick={() => setActiveAnnee('')}>×</div>
                    </div>
                )}
                {activeConditionnement && (
                    <div className='filterOn'>
                        {activeConditionnement}
                        <div onClick={() => setActiveConditionnement('')}>×</div>
                    </div>
                )}
                {activeFamille && (
                    <div className='filterOn'>
                        {activeFamille}
                        <div onClick={() => setActiveFamille('')}>×</div>
                    </div>
                )}
            </div>
            <ul className='lmj-plant-list'>
                {currentPlants.map(({ id,idFournisseur, cover, name, stock, conditionnement, reference, category, price }) => (
                    <div key={id}>
                        <PlantItem
                            cover={cover}
                            name={name}
                            stock={stock}
                            conditionnement={conditionnement}
                            reference={reference}
                            price={price}
                            id={id}
                            idFournisseur={idFournisseur}
                            addToCart={addToCart} // Passer addToCart en prop
                        />
                    </div>
                ))}
            </ul>
            <div className='pagination'>
                <button onClick={handlePreviousPage} disabled={currentPage === 1}>Précédent</button>
                <span>{currentPage} sur {totalPages}</span>
                <button onClick={handleNextPage} disabled={currentPage === totalPages}>Suivant</button>
            </div>
        </div>
    );
}

export default ShoppingList;
