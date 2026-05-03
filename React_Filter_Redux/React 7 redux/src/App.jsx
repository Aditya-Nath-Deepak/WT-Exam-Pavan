import React, { useState } from 'react';
import { configureStore, createSlice } from '@reduxjs/toolkit';
import { Provider, useSelector, useDispatch } from 'react-redux';
import './App.css';

// --- REDUX LOGIC ---

/**
 * Initial state for the products store.
 * Includes a list of hardcoded items and default filter values.
 * this initialState object is the redux state
 */
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

/**
 * Redux Toolkit Slice to manage product filtering state.
 */
const productsSlice = createSlice({
  name: 'products',
  initialState,
  reducers: {
    // Updates the current category filter
    setCategory: (state, action) => {
      state.categoryFilter = action.payload;
    },
    // Updates the maximum price limit
    setPrice: (state, action) => {
      state.maxPrice = action.payload;
    },
    // Resets both filters back to their initial values
    resetFilters: (state) => {
      state.categoryFilter = initialState.categoryFilter;
      state.maxPrice = initialState.maxPrice;
    }
  },
});

// Export actions for use in dispatch
const { setCategory, setPrice, resetFilters } = productsSlice.actions;
// Configure the central Redux store
const store = configureStore({ reducer: { products: productsSlice.reducer } });

// --- COMPONENTS ---

const ProductApp = () => {
  const dispatch = useDispatch();
  // Access state from the Redux store
  const { items, categoryFilter, maxPrice } = useSelector((state) => state.products);
  const [toast, setToast] = useState('');

  /**
   * Derived state: Filter the items array based on the current store state.
   * This logic runs on every re-render when category or price changes.
   */
  const filteredProducts = items.filter((p) => 
    (categoryFilter === 'All' || p.category === categoryFilter) && p.price <= maxPrice
  );

  /**
   * Helper to dispatch actions and show a temporary toast message.
   */
  const handleFilterChange = (type, value) => {
    if (type === 'cat') dispatch(setCategory(value));
    if (type === 'price') dispatch(setPrice(Number(value))); // Ensure price is handled as a number
    
    setToast(`Applied filter: ${value}`);
    setTimeout(() => setToast(''), 2000);
  };

  /**
   * Resets all filters via Redux and notifies the user.
   */
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

      {/* Filter Controls Section */}
      <section className="filter-section">
        <div className="filter-group">
          <label>Category:</label>
          <select 
            value={categoryFilter} // Sync select with Redux state
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
            value={maxPrice} // Sync range input with Redux state
            onChange={(e) => handleFilterChange('price', e.target.value)} 
          />
        </div>

        {/* Button to reset filters */}
        <button className="reset-btn" onClick={handleReset}>Reset All Filters</button>
      </section>

      {/* Display Grid for Filtered Products */}
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

      {/* Conditional rendering for Toast notifications */}
      {toast && <div className="toast">{toast}</div>}
    </div>
  );
};

/**
 * Main App component wrapped in the Redux Provider.
 */
export default function App() {
  return (
    <Provider store={store}>
      <ProductApp />
    </Provider>
  );
}