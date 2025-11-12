import React from 'react'
import SearchBar from "@/app/components/searchBar";
import ReactDOM from 'react-dom'


export default function Home() {
    return (
        <main style={{ padding: "2rem", fontFamily: "sans-serif" }}>
            <h1>My Fake Store</h1>
            <p>Here you will find a variety of items from the FakeStoreAPI</p>
            <SearchBar />
        </main>
    );
}
