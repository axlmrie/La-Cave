import { useState, useEffect, useContext } from 'react';
import '../Styles/Cart.css';


const promoCodes = {
    'Alcool10': 10,
    'di23': 23
};

function Cart({ cart, updateCart ,setItemCount,setCartOpen}) {
    const [promoCode, setPromoCode] = useState('');
    const [discount, setDiscount] = useState(0);
    const [total, setTotal] = useState(0);

    useEffect(() => {
        const newTotal = cart.reduce((acc, plantType) => acc + plantType.amount * plantType.price, 0);
        setTotal(newTotal);
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

    setItemCount(cart.length);

    const panier = ()=>{
        setCartOpen(true)
    }

    return (
        <div className='lmj-cart' id="cart">
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
                    <br>
                    </br>
                    <div id="divPanier">
                    <button onClick={panier}>Passer commande</button>
                    <input
                        type="text"
                        id="btnPromo"
                        placeholder="Code promo"
                        value={promoCode}
                        onChange={(e) => setPromoCode(e.target.value)}
                    />
                    <button onClick={applyPromoCode}>Appliquer le code promo</button>
                    <button id="btnVider" onClick={() => updateCart([])}>Vider le panier</button>
                    </div>
                </div>
            ) : (
                <div>Votre panier est vide</div>
            )}
        </div>
    )
}

export default Cart;
