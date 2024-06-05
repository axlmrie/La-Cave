import { useState, useEffect } from 'react';
import './boutique.css';
import Banner from './Banner';
import Cart from './Cart';
import ShoppingList from './ShoppingList';
import Footer from './Footer';
import '../Styles/Layout.css';
import AgeVerification from './ageVerification'; // Import du composant AgeVerification

function Boutique() {
    const savedCart = localStorage.getItem('cart');
    const [cart, updateCart] = useState(savedCart ? JSON.parse(savedCart) : []);
    const [isAdult, setIsAdult] = useState(localStorage.getItem('isAdult') || false);

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
            {isAdult && (
                <>
                    <Banner />
                    <div className='lmj-layout-inner'>
                        <Cart cart={cart} updateCart={updateCart} />
                        <ShoppingList cart={cart} updateCart={updateCart} />
                    </div>
                    <Footer />
                </>
            )}
        </div>
    );
}

export default Boutique;
