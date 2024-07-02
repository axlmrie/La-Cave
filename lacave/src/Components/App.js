import { useState, useEffect } from 'react';
import '../Styles/boutique.css';
import Banner from './Banner';
import Cart from './Cart';
import ShoppingList from './ShoppingList';
import Footer from './Footer';
import '../Styles/Layout.css';
import AgeVerification from './ageVerification'; // Import du composant AgeVerification
import Filter from './filtre/filter';
import Panier from './panier';

function Boutique() {
    const savedCart = localStorage.getItem('cart');
    const [itemCount,setItemCount] = useState('')
    const [activeCategory, setActiveCategory] = useState('');
    const [activeConditionnement,setActiveConditionnement] = useState('')
    const [activeFamille,setActiveFamille] = useState('')
    const [activeAnnee,setActiveAnnee]=useState('')
    const [priceRange, setPriceRange] = useState([0, 1000]);
    const [cart, updateCart] = useState(savedCart ? JSON.parse(savedCart) : []);
    const [isAdult, setIsAdult] = useState(localStorage.getItem('isAdult') || false);
    const [cartOpen,setCartOpen] = useState(false);


    useEffect(() => {
        localStorage.setItem('cart', JSON.stringify(cart));
    }, [cart]);

    const handleAgeVerification = (isAdult) => {
        setIsAdult(isAdult);
        if (!isAdult) {
            alert("Vous devez être majeur pour accéder à ce site.");
            window.location.href = 'https://www.google.com'; // Redirige vers Google si non majeur
        }
    };

    return (
        <div>
            {!isAdult && <AgeVerification onVerify={handleAgeVerification} />}
            {isAdult && (!cartOpen &&
                <>
                    <Banner  itemCount={itemCount}/>
                    <div className='lmj-layout-inner'>
                        <Filter 
                        activeCategory={activeCategory} 
                        setActiveCategory={setActiveCategory}
                        activeConditionnement={activeConditionnement}
                        setActiveConditionnement={setActiveConditionnement}
                        activeFamille={activeFamille}
                        setActiveFamille={setActiveFamille}
                        activeAnnee={activeAnnee}
                        setActiveAnnee={setActiveAnnee}
                        priceRange={priceRange}
                        setPriceRange={setPriceRange}/>
                        <Cart cart={cart} updateCart={updateCart} setItemCount={setItemCount} setCartOpen={setCartOpen}/>
                        <ShoppingList 
                        cart={cart} 
                        updateCart={updateCart} 
                        activeCategory={activeCategory} 
                        setActiveCategory={setActiveCategory}
                        activeConditionnement={activeConditionnement}
                        setActiveConditionnement={setActiveConditionnement}
                        activeFamille={activeFamille}
                        setActiveFamille={setActiveFamille}
                        activeAnnee={activeAnnee}
                        setActiveAnnee={setActiveAnnee}
                        priceRange={priceRange}
                        setPriceRange={setPriceRange}/>
                    </div>
                    <Footer />
                </>
            )}{
                isAdult &&(
                    cartOpen && 
                    <>
                    <Panier cart={cart} updateCart={updateCart} setCartOpen={setCartOpen}/>
                    </>
                )
            }
        </div>
    );
}

export default Boutique;
