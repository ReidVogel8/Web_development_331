"use client"; // needed for React state/hooks

import { useState, useEffect } from "react";

export default function SearchBar() {
    const [products, setProducts] = useState([]);
    const [search, setSearch] = useState("");

    useEffect(() => {
        fetch("https://fakestoreapi.com/products?limit=20")
            .then((res) => res.json())
            .then((data) => setProducts(data))
            .catch((err) => console.error(err));
    }, []);

    const filteredProducts = products.filter((product) =>
        product.title.toLowerCase().includes(search.toLowerCase())
    );

    return (
        <div style={{ padding: "2rem" }}>
            <input
                type="text"
                placeholder="Search products..."
                value={search}
                onChange={(e) => setSearch(e.target.value)}
                style={{ padding: "0.5rem", marginBottom: "1rem", width: "100%" }}
            />

            <table style={{ width: "100%", borderCollapse: "collapse" }}>
                <thead>
                <tr>
                    <th style={{ border: "1px solid black", padding: "0.5rem" }}>Image</th>
                    <th style={{ border: "1px solid black", padding: "0.5rem" }}>Title</th>
                    <th style={{ border: "1px solid black", padding: "0.5rem" }}>Price</th>
                </tr>
                </thead>
                <tbody>
                {filteredProducts.map((product) => (
                    <tr key={product.id}>
                        <td style={{ border: "1px solid black", padding: "0.5rem" }}>
                            <img src={product.image} alt={product.title} width={50} />
                        </td>
                        <td style={{ border: "1px solid black", padding: "0.5rem" }}>
                            {product.title}
                        </td>
                        <td style={{ border: "1px solid black", padding: "0.5rem" }}>
                            ${product.price.toFixed(2)}
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}

