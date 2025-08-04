# 🛒 DecoCraft - Art & Home Decor E-Commerce Store

A modern, responsive e-commerce platform built with PHP, MySQL, and Bootstrap for selling handcrafted art pieces and home decor items. Features a complete shopping experience with admin panel, user management, and secure checkout.

## ✨ Features

### 🛍️ Shopping Experience
- **Product Catalog** - Browse handcrafted art pieces and home decor items
- **Product Details** - Detailed product pages with images, descriptions, and pricing
- **Shopping Cart** - Add/remove items with quantity management
- **Wishlist** - Save favorite items for later
- **Search & Filter** - Find products by category, price, or keywords

### 👤 User Management
- **User Registration** - Secure account creation with email verification
- **User Login** - Password-protected accounts with session management
- **Profile Management** - Update personal information and addresses
- **Order History** - View past orders and track status

### 🛡️ Admin Panel
- **Dashboard** - Overview of sales, orders, and customer statistics
- **Product Management** - Add, edit, and delete products with image upload
- **Order Management** - View and update order status
- **Customer Management** - View customer details and order history
- **News/Blog Management** - Create and manage blog posts
- **Contact Messages** - Manage customer inquiries

## 🗄️ Database Structure

### Core Tables
- `users` - Customer accounts
- `products` - Product catalog
- `categories` - Product categories
- `orders` - Customer orders
- `order_items` - Individual items in orders
- `cart` - Shopping cart items
- `testimonials` - Customer reviews
- `news` - Blog posts
- `contact_messages` - Customer inquiries

### Admin Tables
- `admin_users` - Admin accounts
- `deals` - Special offers and discounts

## 🎯 Usage

### For Users
1. Browse products on the homepage
2. Register/login to your account
3. Add items to cart
4. Proceed to checkout
5. Receive order confirmation via email

### For Admins
1. Login at `/admin`
2. Access dashboard for overview
3. Manage products, orders, and customers
4. Create blog posts and special offers

## 📊 Admin Panel Features

### Dashboard Overview
- Total sales and revenue
- Recent orders
- Customer statistics
- Product performance

### Product Management
- Add new products with images
- Edit existing products
- Set pricing and inventory
- Manage product categories

### Order Management
- View order details
- Update order status
- Generate invoices
- Process refunds

## 🚀 Performance Optimization

- **Image Optimization** - WebP format with fallbacks
- **Lazy Loading** - Images load on scroll
- **Caching** - Browser and server-side caching
- **CDN Ready** - Easy integration with CDN services
- **Minified Assets** - CSS and JavaScript minification
