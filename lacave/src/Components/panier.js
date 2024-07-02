// panier.js
import React, { useEffect, useState } from 'react';
import Banner from "./Banner";
import '../Styles/panier.css';


const Panier = ({ cart, updateCart, promoCodes, setCartOpen }) => {
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

  const pay = () => {
    console.log("plapl");
  }

  const totalAfterDiscount = total - (total * discount / 100);

  return (
    <div className="panier">
      <Banner />
      {cart.length > 0 ? (
        <>
          <h1 className="title">Panier</h1>
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
                    = {calculateDiscountedPrice(price) * amount}€
                  </div>
                )}
              </div>
            ))}
          </ul>
          <h3>Total : {totalAfterDiscount.toFixed(2)}€</h3>
          <div className="promo">
            <input
              type="text"
              placeholder="Code promo"
              value={promoCode}
              onChange={(e) => setPromoCode(e.target.value)}
            />
            <button onClick={applyPromoCode}>Appliquer le code promo</button>
          </div>
          <button onClick={pay}>Commander</button>
     
          <button onClick={() => updateCart([])}>Vider le panier</button>
        </>
      ) : (
        <div>
          <div className="empty">Votre panier est vide</div>
          <button className="backtoBoutique" onClick={() => setCartOpen(false)}>Retour à la boutique</button>
        </div>
      )}
    </div>
  );
}

export default Panier;
