import { useState, useEffect } from 'react';
import { plantList, creaVinList } from '../Datas/plantList';
import '../Styles/ShoppingList.css';
import PlantItem from './PlantItem';
import Categories from './Categories';

function ShoppingList({ cart, updateCart }) {
    const [activeCategory, setActiveCategory] = useState('');
    const [plants, setPlants] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 25;

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
    }, []); // Ajout d'une dépendance vide pour n'exécuter qu'au montage

    const categories = plants.reduce(
        (acc, plant) =>
            acc.includes(plant.category) ? acc : acc.concat(plant.category),
        []
    );

    function addToCart(name, price) {
        const currentPlantSaved = cart.find((plant) => plant.name === name);
        if (currentPlantSaved) {
            const cartFilteredCurrentPlant = cart.filter(
                (plant) => plant.name !== name
            );
            updateCart([
                ...cartFilteredCurrentPlant,
                { name, price, amount: currentPlantSaved.amount + 1 }
            ]);
        } else {
            updateCart([...cart, { name, price, amount: 1 }]);
        }
    }

    // Filtrer les plantes en fonction de la catégorie active
    const filteredPlants = activeCategory
        ? plants.filter((plant) => plant.category === activeCategory)
        : plants;

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
            <Categories
                categories={categories}
                setActiveCategory={setActiveCategory}
                activeCategory={activeCategory}
            />
            <ul className='lmj-plant-list'>
                {currentPlants.map(({ id, cover, name, stock, conditionnement, reference, category, price }) => (
                    <div key={id}>
                        <PlantItem
                            cover={cover}
                            name={name}
                            stock={stock}
                            conditionnement={conditionnement}
                            reference={reference}
                            price={price}
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
