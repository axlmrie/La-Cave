import { useState, useEffect } from "react";

const Vins = () => {
    class Article {
        constructor(ref, designation, conditionement, stock, prix, idFamille) {
            this.ref = ref;
            this.designation = designation;
            this.conditionement = conditionement;
            this.stock = stock;
            this.prix = prix;
            this.idFamille = idFamille;
        }
    }

    const createArticleTab = async () => {
        const articleTab = [];
        const response = await fetch('http://localhost:8080/articles/FindAll');
        const data = await response.json();
        setLenArticles(data.length);
        console.log(data);
        data.forEach((element) => {
            articleTab.push(
                new Article(
                    element.reference,
                    element.designation,
                    element.conditionnement,
                    element.stock,
                    element.prix,
                    element.famille.cepage
                )
            );
        });
        setArticles(articleTab);
    };

    const [articles, setArticles] = useState([]);
    const [lenArticles, setLenArticles] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const [rowsPerPage, setRowsPerPage] = useState(25);
    const [sortConfig, setSortConfig] = useState({ key: null, direction: 'ascending' });

    // State for form data
    const [formData, setFormData] = useState({ reference: '', designation: '', conditionnement: '', stock: 0, prix: 0, famille:{idFamille:'' }});
    const [isEditing, setIsEditing] = useState(false);

    const totalPages = Math.ceil(lenArticles / rowsPerPage);

    useEffect(() => {
        createArticleTab();
    }, [createArticleTab]);

    const displayPage = () => {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        return articles.slice(start, end);
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
        setArticles((prevArticles) => {
            const sortedArticles = [...prevArticles];
            sortedArticles.sort((a, b) => {
                if (a[key] < b[key]) {
                    return direction === 'ascending' ? -1 : 1;
                }
                if (a[key] > b[key]) {
                    return direction === 'ascending' ? 1 : -1;
                }
                return 0;
            });
            return sortedArticles;
        });
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        const [field, subfield] = name.split('.');
        if (subfield) {
            setFormData({
                ...formData,
                [field]: {
                    ...formData[field],
                    [subfield]: value,
                },
            });
        } else {
            setFormData({
                ...formData,
                [name]: value,
            });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const method = isEditing ? 'PUT' : 'POST';
        const url = isEditing ? `http://localhost:8080/articles/${formData.id}` : 'http://localhost:8080/articles/create';

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        if (response.ok) {
            createArticleTab();
            setFormData({ reference: '', designation: '', conditionnement: '', stock: 0, prix: 0, famille:{idFamille:'' }});
            setIsEditing(false);
        } else {
            console.error('Failed to save article');
        }
    };

    const handleEdit = (article) => {
        setFormData(article);
        setIsEditing(true);
    };

    return (
        <>
            <div>
                <div>
                    <h2>Vins</h2>
                    <div>
                        <label htmlFor="rowsPerPage">Lignes par page: </label>
                        <select id="rowsPerPage" value={rowsPerPage} onChange={handleRowsPerPageChange}>
                            <option value={25}>25</option>
                            <option value={50}>50</option>
                            <option value={100}>100</option>
                        </select>
                    </div>
                    <form onSubmit={handleSubmit}>
                        <div>
                            <label>Référence: </label>
                            <input type="text" name="reference" value={formData.ref} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Désignation: </label>
                            <input type="text" name="designation" value={formData.designation} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Conditionnement: </label>
                            <input type="text" name="conditionnement" value={formData.conditionement} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Stock: </label>
                            <input type="number" name="stock" value={formData.stock} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Prix: </label>
                            <input type="number" name="prix" value={formData.prix} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>ID Famille: </label>
                            <input type="text" name="famille.idFamille" value={formData.famille.idFamille} onChange={handleChange} required />
                        </div>
                        <button type="submit">{isEditing ? 'Modifier' : 'Créer'}</button>
                    </form>
                    <table>
                        <thead>
                            <tr>
                                <th onClick={() => requestSort('ref')}>Référence</th>
                                <th onClick={() => requestSort('designation')}>Désignation</th>
                                <th onClick={() => requestSort('conditionement')}>Conditionnement</th>
                                <th onClick={() => requestSort('stock')}>Stock</th>
                                <th onClick={() => requestSort('prix')}>Prix</th>
                                <th onClick={() => requestSort('idFamille')}>cepage</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {articles && articles.length > 0 && displayPage().map((article, index) => (
                                <tr key={index}>
                                    <td>{article.ref}</td>
                                    <td>{article.designation}</td>
                                    <td>{article.conditionement}</td>
                                    <td>{article.stock}</td>
                                    <td>{article.prix}</td>
                                    <td>{article.idFamille}</td>
                                    <td>
                                        <button onClick={() => handleEdit(article)}>Modifier</button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    <div className="pagination">
                        <button onClick={prevPage} disabled={currentPage === 1}>Précédent</button>
                        <span className="pageSur">Page {currentPage} de {totalPages}</span>
                        <button onClick={nextPage} disabled={currentPage === totalPages}>Suivant</button>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Vins;
