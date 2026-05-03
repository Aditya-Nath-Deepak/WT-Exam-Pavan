import React, { useState } from 'react';
import { configureStore, createSlice } from '@reduxjs/toolkit';
import { Provider, useSelector, useDispatch } from 'react-redux';
import './App.css';

// --- REDUX LOGIC ---

// Define initial filter states for easy resetting
const initialState = {
  items: [
    { id: 1, name: 'iPhone 15', category: 'Electronics', price: 999 },
    { id: 2, name: 'Leather Jacket', category: 'Clothing', price: 150 },
    { id: 3, name: 'Mechanical Keyboard', category: 'Electronics', price: 100 },
    { id: 4, name: 'Running Shoes', category: 'Clothing', price: 80 },
    { id: 5, name: 'Coffee Maker', category: 'Home', price: 50 },
  ],
  categoryFilter: 'All',
  maxPrice: 1000,
};

const productsSlice = createSlice({
  name: 'products',
  initialState,
  reducers: {
    setCategory: (state, action) => {
      state.categoryFilter = action.payload;
    },
    setPrice: (state, action) => {
      state.maxPrice = action.payload;
    },
    // TASK 5: Implement Reset Logic
    resetFilters: (state) => {
      state.categoryFilter = initialState.categoryFilter;
      state.maxPrice = initialState.maxPrice;
    }
  },
});

const { setCategory, setPrice, resetFilters } = productsSlice.actions;
const store = configureStore({ reducer: { products: productsSlice.reducer } });

// --- COMPONENTS ---

const ProductApp = () => {
  const dispatch = useDispatch();
  const { items, categoryFilter, maxPrice } = useSelector((state) => state.products);
  const [toast, setToast] = useState('');

  const filteredProducts = items.filter((p) => 
    (categoryFilter === 'All' || p.category === categoryFilter) && p.price <= maxPrice
  );

  const handleFilterChange = (type, value) => {
    if (type === 'cat') dispatch(setCategory(value));
    if (type === 'price') dispatch(setPrice(Number(value))); // Ensure price is a number
    
    setToast(`Applied filter: ${value}`);
    setTimeout(() => setToast(''), 2000);
  };

  const handleReset = () => {
    dispatch(resetFilters());
    setToast('Filters Reset');
    setTimeout(() => setToast(''), 2000);
  };

  return (
    <div className="container">
      <header>
        <h1>Product Store</h1>
        <p>Use Redux to filter by category and price</p>
      </header>

      <section className="filter-section">
        <div className="filter-group">
          <label>Category:</label>
          <select 
            value={categoryFilter} // Controlled component
            onChange={(e) => handleFilterChange('cat', e.target.value)}
          >
            <option value="All">All Categories</option>
            <option value="Electronics">Electronics</option>
            <option value="Clothing">Clothing</option>
            <option value="Home">Home</option>
          </select>
        </div>

        <div className="filter-group">
          <label>Max Price: ₹{maxPrice}</label>
          <input 
            type="range" min="0" max="1000" step="50" 
            value={maxPrice} // Controlled component
            onChange={(e) => handleFilterChange('price', e.target.value)} 
          />
        </div>

        {/* TASK 5 UI: Reset Button */}
        <button className="reset-btn" onClick={handleReset}>Reset All Filters</button>
      </section>

      <div className="product-grid">
        {filteredProducts.length > 0 ? (
          filteredProducts.map(product => (
            <div key={product.id} className="product-card">
              <h3>{product.name}</h3>
              <p className="category">{product.category}</p>
              <p className="price">₹{product.price}</p>
            </div>
          ))
        ) : (
          <p className="no-results">No products found in this range.</p>
        )}
      </div>

      {toast && <div className="toast">{toast}</div>}
    </div>
  );
};

export default function App() {
  return (
    <Provider store={store}>
      <ProductApp />
    </Provider>
  );
}