import { useState, useEffect } from "react";

const StockActuel = () => {
  class Articles {
    constructor(reference, designation, stock, conditionnement, prix) {
      this.reference = reference;
      this.designation = designation;
      this.stock = stock;
      this.conditionnement = conditionnement;
      this.prix = prix;
    }
  }

  const createRuptureTab = async () => {
    const ruptureTab = [];
    const response = await fetch('http://localhost:8080/articles/FindAll');
    const data = await response.json();
    setLenRupture(data.length);
    data.forEach((element) => {
      console.log(element)
      ruptureTab.push(
        new Articles(
          element.reference,
          element.designation,
          element.stock,
          element.conditionnement,
          element.prix
        )
      );
    });
    setRupture(ruptureTab);
  };

  const [rupture, setRupture] = useState([]);
  const [lenRupture, setLenRupture] = useState(0);
  const [currentPage, setCurrentPage] = useState(1);
  const [rowsPerPage, setRowsPerPage] = useState(25);
  const [sortConfig, setSortConfig] = useState({ key: null, direction: 'ascending' });
  const [selectedArticle, setSelectedArticle] = useState(null);
  const [isOrdering, setIsOrdering] = useState(false);
  const [quantity, setQuantity] = useState(0);

  const totalPages = Math.ceil(lenRupture / rowsPerPage);

  useEffect(() => {
    createRuptureTab();
  }, [createRuptureTab]);

  const displayPage = () => {
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    return rupture.slice(start, end);
  };

  const nextPage = () => {
    if (currentPage < totalPages) {
      setCurrentPage(currentPage + 1);
    }
  };

  const prevPage = () => {
    if (currentPage > 1) {
      setCurrentPage(currentPage - 1);
    }
  };

  const handleRowsPerPageChange = (event) => {
    setRowsPerPage(parseInt(event.target.value, 10));
    setCurrentPage(1); // Reset to first page
  };

  const requestSort = (key) => {
    let direction = 'ascending';
    if (sortConfig.key === key && sortConfig.direction === 'ascending') {
      direction = 'descending';
    }
    setSortConfig({ key, direction });
    setRupture((prevRupture) => {
      const sortedRupture = [...prevRupture];
      sortedRupture.sort((a, b) => {
        if (a[key] < b[key]) {
          return direction === 'ascending' ? -1 : 1;
        }
        if (a[key] > b[key]) {
          return direction === 'ascending' ? 1 : -1;
        }
        return 0;
      });
      return sortedRupture;
    });
  };

  const handleArticleClick = (article) => {
    setSelectedArticle(article);
  };

  const handleBackClick = () => {
    setSelectedArticle(null);
    setIsOrdering(false);
  };

  const handleOrderClick = () => {
    setIsOrdering(true);
  };

  const handleOrderSubmit = () => {
    // Logique de commande, vous pouvez envoyer les données de commande au serveur ici
    console.log(`Commande passée pour ${quantity} unités de ${selectedArticle.type}`);
    // Réinitialiser l'état après la commande
    setIsOrdering(false);
    setQuantity(0);
  };

  const handleQuantityChange = (event) => {
    setQuantity(parseInt(event.target.value, 10));
  };

  return (
    <div>
      {selectedArticle ? (
        <div className="details">
          <h2>Détails de l'article</h2>
          <p><strong>Type:</strong> {selectedArticle.type}</p>
          <p><strong>Domaine:</strong> {selectedArticle.domaine}</p>
          <p><strong>Fournisseur:</strong> {selectedArticle.fournisseur}</p>
          <p><strong>Conditionnement:</strong> {selectedArticle.conditionnement}</p>
          <p><strong>Année:</strong> {selectedArticle.annee}</p>
          <p><strong>Stock:</strong> {selectedArticle.stock}</p>
          <button onClick={handleBackClick}>Retour</button>
          {!isOrdering ? (
            <button onClick={handleOrderClick}>Commander</button>
          ) : (
            <div>
              <input
                type="number"
                value={quantity}
                onChange={handleQuantityChange}
                placeholder="Quantité"
              />
              <button onClick={handleOrderSubmit}>Valider</button>
              <button onClick={handleBackClick}>Annuler</button>
            </div>
          )}
        </div>
      ) : (
        <>
          <h2>Stock Actuelle</h2>
          <div>
            <label htmlFor="rowsPerPage">Lignes par page: </label>
            <select id="rowsPerPage" value={rowsPerPage} onChange={handleRowsPerPageChange}>
              <option value={25}>25</option>
              <option value={50}>50</option>
              <option value={100}>100</option>
            </select>
          </div>
          <table>
            <thead>
              <tr>
              <th onClick={() => requestSort('reference')}>Référence</th>
                <th onClick={() => requestSort('designation')}>Désignation</th>
                <th onClick={() => requestSort('stock')}>Stock</th>
                <th onClick={() => requestSort('conditionnement')}>Conditionnement</th>
                <th onClick={() => requestSort('prix')}>Prix</th>
              </tr>
            </thead>
            <tbody>
            {rupture && rupture.length > 0 && displayPage().map((article, index) => (
                <tr key={index} onClick={() => handleArticleClick(article)}>
                  <td>{article.reference}</td>
                  <td>{article.designation}</td>
                  <td>
                    {article.stock} {article.stock < 10 && <span style={{color: 'red'}}>⚠️</span>}
                  </td>
                  <td>{article.conditionnement}</td>
                  <td>{article.prix} €</td>
                </tr>
              ))}
            </tbody>
          </table>
          <div className="pagination">
            <button onClick={prevPage} disabled={currentPage === 1}>Précédent</button>
            <span className="pageSur">Page {currentPage} de {totalPages}</span>
            <button onClick={nextPage} disabled={currentPage === totalPages}>Suivant</button>
          </div>
        </>
      )}
    </div>
  );
};

export default StockActuel;
