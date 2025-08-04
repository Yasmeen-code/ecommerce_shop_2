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

### 💳 Payment & Checkout
- **Secure Checkout** - Multi-step checkout process
- **Multiple Payment Methods** - Credit card, PayPal, and cash on delivery
- **Order Confirmation** - Email notifications for orders
- **Invoice Generation** - PDF invoices for completed orders

### 📱 Responsive Design
- **Mobile-First** - Optimized for all devices
- **Fast Loading** - Optimized images and caching
- **SEO Friendly** - Clean URLs and meta tags

## 🚀 Technology Stack

- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Frontend:** HTML5, CSS3, JavaScript
- **CSS Framework:** Bootstrap 5
- **JavaScript Libraries:** jQuery, Owl Carousel
- **Icons:** Font Awesome
- **Payment:** PayPal API, Stripe (optional)

## 📦 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependencies)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/decocraft-ecommerce.git
   cd decocraft-ecommerce
   ```

2. **Create database**
   ```sql
   CREATE DATABASE decocraft_store;
   ```

3. **Import database schema**
   ```bash
   mysql -u username -p decocraft_store < database/decocraft_store.sql
   ```

4. **Configure database connection**
   Edit `includes/db.php`:
   ```php
   $host = 'localhost';
   $dbname = 'decocraft_store';
   $username = 'your_username';
   $password = 'your_password';
   ```

5. **Set up environment variables**
   Create `.env` file:
   ```
   DB_HOST=localhost
   DB_NAME=decocraft_store
   DB_USER=your_username
   DB_PASS=your_password
   ```

6. **Configure PayPal (optional)**
   Edit `config/paypal.php` with your PayPal credentials

7. **Set file permissions**
   ```bash
   chmod 755 -R uploads/
   chmod 644 .htaccess
   ```

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

## 🔧 Configuration

### Payment Settings
Configure payment gateways in `config/payment.php`:
```php
return [
    'paypal' => [
        'client_id' => 'your_paypal_client_id',
        'secret' => 'your_paypal_secret',
        'sandbox' => true
    ],
    'stripe' => [
        'publishable_key' => 'your_stripe_publishable_key',
        'secret_key' => 'your_stripe_secret_key'
    ]
];
```

### Email Settings
Configure email notifications in `config/email.php`:
```php
return [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'username' => 'your_email@gmail.com',
    'password' => 'your_app_password'
];
```

## 🎨 Customization

### Changing Theme Colors
Edit `assets/css/main.css`:
```css
:root {
    --primary-color: #ff6b6b;
    --secondary-color: #4ecdc4;
    --accent-color: #45b7d1;
}
```

### Adding New Product Categories
1. Add category in `admin/add_category.php`
2. Upload category images to `assets/img/categories/`
3. Update navigation in `includes/header.php`

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

## 🔒 Security Features

- **SQL Injection Prevention** - Prepared statements
- **XSS Protection** - Input sanitization
- **CSRF Protection** - Token validation
- **Password Hashing** - bcrypt encryption
- **Session Management** - Secure sessions
- **File Upload Security** - Type and size validation

## 📱 Mobile Responsiveness

- **Breakpoints:**
  - Mobile: 320px - 768px
  - Tablet: 768px - 1024px
  - Desktop: 1024px+
- **Touch-friendly** buttons and navigation
- **Optimized images** for mobile devices

## 🚀 Performance Optimization

- **Image Optimization** - WebP format with fallbacks
- **Lazy Loading** - Images load on scroll
- **Caching** - Browser and server-side caching
- **CDN Ready** - Easy integration with CDN services
- **Minified Assets** - CSS and JavaScript minification

## 🧪 Testing

### Manual Testing Checklist
- [ ] User registration and login
- [ ] Product browsing and search
- [ ] Shopping cart functionality
- [ ] Checkout process
- [ ] Payment processing
- [ ] Admin panel access
- [ ] Order management
- [ ] Email notifications

### Automated Testing
```bash
# Run PHP unit tests
./vendor/bin/phpunit tests/

# Run JavaScript tests
npm test
```

## 📈 SEO Optimization

- **Meta Tags** - Dynamic meta descriptions
- **Schema Markup** - Product and review schemas
- **Sitemap** - XML sitemap generation
- **Clean URLs** - SEO-friendly URLs
- **Social Media** - Open Graph tags

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support, email support@decocraft.com or join our Slack channel.

## 🙏 Acknowledgments

- Bootstrap team for the excellent framework
- Font Awesome for icons
- Unsplash for product images
- PayPal for payment integration

---

**Made with ❤️ by the DecoCraft Team**
