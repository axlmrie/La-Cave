import React from 'react';
import '../Styles/AgeVerification.css';
import logo from '../Assets/logo.png'

function AgeVerification({ onVerify }) {
    const handleVerify = (isAdult) => {
        if (isAdult) {
            localStorage.setItem('isAdult', true);
        }
        onVerify(isAdult);
    };

    return (
        <div className="age-verification-overlay">
            <div className="age-verification-modal">
                <img src={logo} className='logo'></img>
                <h2>Êtes-vous majeur ?</h2>
                <button onClick={() => handleVerify(true)} className='oui'>Oui j'ai plus de 18 ans - Entrer</button>
                <button onClick={() => handleVerify(false)}className='non'>Non J'ai moins de 18 ans - Sortir</button>
            </div>
        </div>
    );
}

export default AgeVerification;
