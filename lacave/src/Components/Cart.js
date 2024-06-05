import { useState, useEffect } from 'react';
import '../Styles/Cart.css';

const promoCodes = {
    'Alcool10': 10,
    'di23': 23
};

function Cart({ cart, updateCart }) {
    const [isOpen, setIsOpen] = useState(true);
    const [promoCode, setPromoCode] = useState('');
    const [discount, setDiscount] = useState(0);
    const [total, setTotal] = useState(0);

    useEffect(() => {
        const newTotal = cart.reduce((acc, plantType) => acc + plantType.amount * plantType.price, 0);
        setTotal(newTotal);
        document.title = `La cave 🍷 : ${newTotal - (newTotal * discount / 100)}€ d'achats 💸`;
    }, [cart, discount]);

    const applyPromoCode = () => {
        if (promoCodes[promoCode]) {
            setDiscount(promoCodes[promoCode]);
        } else {
            alert('Code promo invalide');
        }
    };

    const calculateDiscountedPrice = (price) => {
        return price - (price * discount / 100);
    };

    const totalAfterDiscount = total - (total * discount / 100);

    return isOpen ? (
        <div className='lmj-cart'>
            <button
                className='lmj-cart-toggle-button'
                onClick={() => setIsOpen(false)}
            >
                Fermer
            </button>
            {cart.length > 0 ? (
                <div>
                    <h2>Panier</h2>
                    <ul className='contenuCart'>
                        {cart.map(({ name, price, amount }, index) => (
                            <div key={`${name}-${index}`}>
                                <div>
                                    {name} {price}€ x {amount} 
                                </div>
                                {discount > 0 && (
                                    <div>
                                        <span style={{ textDecoration: 'line-through', color: 'red' }}>
                                            {price * amount}€
                                        </span>
                                        {' '}
                                        =  {calculateDiscountedPrice(price) * amount}€
                                    </div>
                                )}
                            </div>
                        ))}
                    </ul>
                    <h3>Total : {totalAfterDiscount.toFixed(2)}€</h3>
                    <input
                        type="text"
                        placeholder="Code promo"
                        value={promoCode}
                        onChange={(e) => setPromoCode(e.target.value)}
                    />
                    <button onClick={applyPromoCode}>Appliquer le code promo</button>
                    <button onClick={() => updateCart([])}>Vider le panier</button>
                </div>
            ) : (
                <div>Votre panier est vide</div>
            )}
        </div>
    ) : (
        <div className='lmj-cart-closed'>
            <button
                className='lmj-cart-toggle-button'
                onClick={() => setIsOpen(true)}
            >
                Ouvrir le Panier
            </button>
        </div>
    );
}

export default Cart;
