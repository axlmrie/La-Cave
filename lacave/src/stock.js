import React from 'react';
import './App.css';
import Header from './header';
import StockContent from './stockContent';
import Footer from './footer';


const Stock = ()=>{
  return (
    <div className='App'>
      <Header/>
      <StockContent/>
      <Footer/>
    </div>
  );
}

export default Stock;
