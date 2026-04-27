"""
Name: Amber Lawson
Date: January 22, 2026
Option: MongoDB (NoSQL Database)
Program Summary: This Python application performs CRUD operations on a MongoDB database
containing Amazon product reviews. It provides a menu-driven interface to interact with
ReviewData and ProductData collections, allowing users to insert, query, update, and delete
data while performing various analytical operations on the review dataset.
"""

import pymongo
import json
import datetime
import sys
from pymongo import MongoClient

class AmazonReviewsDB:
    def __init__(self):
        """Initialize MongoDB connection"""
        try:
            # Connect to MongoDB container
            self.client = MongoClient('mongodb://localhost:27017/')
            self.db = self.client['Amazon_EN_Reviews']
            self.review_collection = self.db['ReviewData']
            self.product_collection = self.db['ProductData']
            print("✅ Connected to MongoDB successfully!")
        except Exception as e:
            print(f"❌ Error connecting to MongoDB: {e}")
            sys.exit(1)
    
    def load_initial_data(self):
        """Load data from JSON file and distribute between collections"""
        try:
            with open('Final Performance Assessment Dataset.json', 'r', encoding='utf-8') as file:
                print("📁 Loading data from JSON file...")
                
                # Clear existing data
                self.review_collection.delete_many({})
                self.product_collection.delete_many({})
                
                review_data = []
                product_data = {}
                
                for line_num, line in enumerate(file, 1):
                    if line.strip():  # Skip empty lines
                        try:
                            data = json.loads(line.strip())
                            
                            # Prepare review data
                            review_doc = {
                                'review_id': data.get('review_id'),
                                'product_id': data.get('product_id'),
                                'reviewer_id': data.get('reviewer_id'),
                                'stars': int(data.get('stars', 0)),
                                'review_body': data.get('review_body'),
                                'review_title': data.get('review_title'),
                                'language': data.get('language')
                            }
                            review_data.append(review_doc)
                            
                            # Prepare product data (avoid duplicates)
                            product_id = data.get('product_id')
                            if product_id not in product_data:
                                product_data[product_id] = {
                                    'product_id': product_id,
                                    'product_category': data.get('product_category'),
                                    'language': data.get('language')
                                }
                        
                        except json.JSONDecodeError as e:
                            print(f"⚠️ Skipping invalid JSON at line {line_num}: {e}")
                            continue
                
                # Insert data in batches
                if review_data:
                    self.review_collection.insert_many(review_data)
                    print(f"✅ Inserted {len(review_data)} reviews into ReviewData collection")
                
                if product_data:
                    self.product_collection.insert_many(list(product_data.values()))
                    print(f"✅ Inserted {len(product_data)} products into ProductData collection")
                    
        except FileNotFoundError:
            print("❌ JSON data file not found. Please ensure 'Final Performance Assessment Dataset.json' exists.")
        except Exception as e:
            print(f"❌ Error loading data: {e}")
    
    def display_menu(self):
        """Display the main menu"""
        print("\n" + "="*60)
        print("🛒 AMAZON REVIEWS DATABASE MANAGEMENT SYSTEM")
        print("="*60)
        print(f"📅 Current Date/Time: {datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')}")
        print("\n📋 MENU OPTIONS:")
        print("1.  📥 Load Initial Data from JSON")
        print("2.  ➕ Insert New Review Data")
        print("3.  ➕ Insert New Product Data")
        print("4.  🔍 Display Review by Review ID")
        print("5.  📂 Display All Distinct Product Categories")
        print("6.  ⭐ Count 4-5 Star Reviews by Category")
        print("7.  ⭐ Count 1-2 Star Reviews by Category")
        print("8.  🔎 Search Reviews by Title (Regex)")
        print("9.  🔎 Search Reviews by Body (Regex)")
        print("10. 🗑️ Delete a Review")
        print("11. 🗑️ Delete All Review Data")
        print("12. 🗑️ Delete All Product Data")
        print("13. 📊 Display Database Statistics")
        print("0.  🚪 Exit")
        print("="*60)
    
    def insert_review_data(self):
        """Insert new review data"""
        print("\n➕ INSERT NEW REVIEW DATA")
        print("-" * 30)
        
        try:
            review_id = input("Enter Review ID: ")
            product_id = input("Enter Product ID: ")
            reviewer_id = input("Enter Reviewer ID: ")
            stars = int(input("Enter Stars (1-5): "))
            review_body = input("Enter Review Body: ")
            review_title = input("Enter Review Title: ")
            language = input("Enter Language (default: en): ") or "en"
            
            review_doc = {
                'review_id': review_id,
                'product_id': product_id,
                'reviewer_id': reviewer_id,
                'stars': stars,
                'review_body': review_body,
                'review_title': review_title,
                'language': language
            }
            
            result = self.review_collection.insert_one(review_doc)
            print(f"✅ Review inserted successfully with ID: {result.inserted_id}")
            
        except ValueError:
            print("❌ Invalid star rating. Please enter a number between 1-5.")
        except Exception as e:
            print(f"❌ Error inserting review: {e}")
    
    def insert_product_data(self):
        """Insert new product data"""
        print("\n➕ INSERT NEW PRODUCT DATA")
        print("-" * 30)
        
        try:
            product_id = input("Enter Product ID: ")
            product_category = input("Enter Product Category: ")
            language = input("Enter Language (default: en): ") or "en"
            
            product_doc = {
                'product_id': product_id,
                'product_category': product_category,
                'language': language
            }
            
            result = self.product_collection.insert_one(product_doc)
            print(f"✅ Product inserted successfully with ID: {result.inserted_id}")
            
        except Exception as e:
            print(f"❌ Error inserting product: {e}")
    
    def display_review_by_id(self):
        """Display review information by review ID"""
        print("\n🔍 SEARCH REVIEW BY ID")
        print("-" * 25)
        
        review_id = input("Enter Review ID: ")
        
        try:
            review = self.review_collection.find_one({'review_id': review_id})
            
            if review:
                print("\n📋 REVIEW DETAILS:")
                print(f"Review ID: {review.get('review_id')}")
                print(f"Product ID: {review.get('product_id')}")
                print(f"Reviewer ID: {review.get('reviewer_id')}")
                print(f"Stars: {'⭐' * review.get('stars', 0)} ({review.get('stars')}/5)")
                print(f"Title: {review.get('review_title')}")
                print(f"Body: {review.get('review_body')[:200]}{'...' if len(review.get('review_body', '')) > 200 else ''}")
                print(f"Language: {review.get('language')}")
                
                # Get associated product info
                product = self.product_collection.find_one({'product_id': review.get('product_id')})
                if product:
                    print(f"Product Category: {product.get('product_category')}")
            else:
                print(f"❌ No review found with ID: {review_id}")
                
        except Exception as e:
            print(f"❌ Error searching for review: {e}")
    
    def display_distinct_categories(self):
        """Display all distinct product categories"""
        print("\n📂 DISTINCT PRODUCT CATEGORIES")
        print("-" * 35)
        
        try:
            categories = self.product_collection.distinct('product_category')
            
            if categories:
                print(f"Found {len(categories)} distinct categories:")
                for i, category in enumerate(sorted(categories), 1):
                    print(f"{i:2d}. {category}")
            else:
                print("❌ No categories found in the database.")
                
        except Exception as e:
            print(f"❌ Error retrieving categories: {e}")
    
    def count_high_star_reviews(self):
        """Count 4-5 star reviews for a category"""
        print("\n⭐ COUNT 4-5 STAR REVIEWS BY CATEGORY")
        print("-" * 40)
        
        category = input("Enter Product Category: ")
        
        try:
            # Get product IDs for this category
            products = self.product_collection.find({'product_category': category})
            product_ids = [p['product_id'] for p in products]
            
            if not product_ids:
                print(f"❌ No products found in category: {category}")
                return
            
            # Count high-rated reviews
            count = self.review_collection.count_documents({
                'product_id': {'$in': product_ids},
                'stars': {'$gte': 4}
            })
            
            print(f"📊 Category: {category}")
            print(f"⭐ 4-5 Star Reviews: {count}")
            
        except Exception as e:
            print(f"❌ Error counting reviews: {e}")
    
    def count_low_star_reviews(self):
        """Count 1-2 star reviews for a category"""
        print("\n⭐ COUNT 1-2 STAR REVIEWS BY CATEGORY")
        print("-" * 40)
        
        category = input("Enter Product Category: ")
        
        try:
            # Get product IDs for this category
            products = self.product_collection.find({'product_category': category})
            product_ids = [p['product_id'] for p in products]
            
            if not product_ids:
                print(f"❌ No products found in category: {category}")
                return
            
            # Count low-rated reviews
            count = self.review_collection.count_documents({
                'product_id': {'$in': product_ids},
                'stars': {'$lte': 2}
            })
            
            print(f"📊 Category: {category}")
            print(f"⭐ 1-2 Star Reviews: {count}")
            
        except Exception as e:
            print(f"❌ Error counting reviews: {e}")
    
    def search_reviews_by_title(self):
        """Search reviews by title using regex"""
        print("\n🔎 SEARCH REVIEWS BY TITLE (REGEX)")
        print("-" * 40)
        
        search_term = input("Enter search term for title: ")
        
        try:
            # Use regex for case-insensitive search
            reviews = self.review_collection.find({
                'review_title': {'$regex': search_term, '$options': 'i'}
            }).limit(10)
            
            results = list(reviews)
            
            if results:
                print(f"\n📋 Found {len(results)} reviews (showing first 10):")
                for i, review in enumerate(results, 1):
                    print(f"\n{i}. Review ID: {review.get('review_id')}")
                    print(f"   Title: {review.get('review_title')}")
                    print(f"   Stars: {'⭐' * review.get('stars', 0)} ({review.get('stars')}/5)")
                    print(f"   Body: {review.get('review_body')[:100]}...")
            else:
                print(f"❌ No reviews found with '{search_term}' in title.")
                
        except Exception as e:
            print(f"❌ Error searching reviews: {e}")
    
    def search_reviews_by_body(self):
        """Search reviews by body using regex"""
        print("\n🔎 SEARCH REVIEWS BY BODY (REGEX)")
        print("-" * 40)
        
        search_term = input("Enter search term for body: ")
        
        try:
            # Use regex for case-insensitive search
            reviews = self.review_collection.find({
                'review_body': {'$regex': search_term, '$options': 'i'}
            }).limit(10)
            
            results = list(reviews)
            
            if results:
                print(f"\n📋 Found {len(results)} reviews (showing first 10):")
                for i, review in enumerate(results, 1):
                    print(f"\n{i}. Review ID: {review.get('review_id')}")
                    print(f"   Title: {review.get('review_title')}")
                    print(f"   Stars: {'⭐' * review.get('stars', 0)} ({review.get('stars')}/5)")
                    print(f"   Body: {review.get('review_body')[:150]}...")
            else:
                print(f"❌ No reviews found with '{search_term}' in body.")
                
        except Exception as e:
            print(f"❌ Error searching reviews: {e}")
    
    def delete_review(self):
        """Delete a specific review"""
        print("\n🗑️ DELETE REVIEW")
        print("-" * 20)
        
        review_id = input("Enter Review ID to delete: ")
        
        try:
            # First check if review exists
            review = self.review_collection.find_one({'review_id': review_id})
            
            if review:
                confirm = input(f"Are you sure you want to delete review '{review_id}'? (y/N): ")
                if confirm.lower() == 'y':
                    result = self.review_collection.delete_one({'review_id': review_id})
                    if result.deleted_count > 0:
                        print(f"✅ Review {review_id} deleted successfully.")
                    else:
                        print("❌ Failed to delete review.")
                else:
                    print("❌ Delete operation cancelled.")
            else:
                print(f"❌ Review with ID '{review_id}' not found.")
                
        except Exception as e:
            print(f"❌ Error deleting review: {e}")
    
    def delete_all_review_data(self):
        """Delete all review data"""
        print("\n🗑️ DELETE ALL REVIEW DATA")
        print("-" * 30)
        
        confirm = input("⚠️  This will delete ALL reviews! Are you sure? (y/N): ")
        if confirm.lower() == 'y':
            double_confirm = input("Type 'DELETE' to confirm: ")
            if double_confirm == 'DELETE':
                try:
                    result = self.review_collection.delete_many({})
                    print(f"✅ Deleted {result.deleted_count} reviews.")
                except Exception as e:
                    print(f"❌ Error deleting reviews: {e}")
            else:
                print("❌ Delete operation cancelled.")
        else:
            print("❌ Delete operation cancelled.")
    
    def delete_all_product_data(self):
        """Delete all product data"""
        print("\n🗑️ DELETE ALL PRODUCT DATA")
        print("-" * 30)
        
        confirm = input("⚠️  This will delete ALL products! Are you sure? (y/N): ")
        if confirm.lower() == 'y':
            double_confirm = input("Type 'DELETE' to confirm: ")
            if double_confirm == 'DELETE':
                try:
                    result = self.product_collection.delete_many({})
                    print(f"✅ Deleted {result.deleted_count} products.")
                except Exception as e:
                    print(f"❌ Error deleting products: {e}")
            else:
                print("❌ Delete operation cancelled.")
        else:
            print("❌ Delete operation cancelled.")
    
    def display_statistics(self):
        """Display database statistics"""
        print("\n📊 DATABASE STATISTICS")
        print("-" * 25)
        
        try:
            review_count = self.review_collection.count_documents({})
            product_count = self.product_collection.count_documents({})
            
            print(f"📄 Total Reviews: {review_count:,}")
            print(f"📦 Total Products: {product_count:,}")
            
            # Star distribution
            print("\n⭐ STAR RATING DISTRIBUTION:")
            for stars in range(1, 6):
                count = self.review_collection.count_documents({'stars': stars})
                percentage = (count / review_count * 100) if review_count > 0 else 0
                print(f"{stars} Star{'s' if stars != 1 else ' '}: {count:,} ({percentage:.1f}%)")
            
            # Top categories
            print("\n📂 TOP 5 PRODUCT CATEGORIES:")
            pipeline = [
                {'$group': {'_id': '$product_category', 'count': {'$sum': 1}}},
                {'$sort': {'count': -1}},
                {'$limit': 5}
            ]
            
            top_categories = list(self.product_collection.aggregate(pipeline))
            for i, cat in enumerate(top_categories, 1):
                print(f"{i}. {cat['_id']}: {cat['count']} products")
                
        except Exception as e:
            print(f"❌ Error retrieving statistics: {e}")
    
    def run(self):
        """Main application loop"""
        print("🚀 Starting Amazon Reviews Database Management System...")
        
        while True:
            try:
                self.display_menu()
                choice = input("\n👉 Enter your choice (0-13): ").strip()
                
                if choice == '0':
                    print("\n👋 Thank you for using Amazon Reviews DB Management System!")
                    print(f"🕐 Session ended at: {datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')}")
                    break
                elif choice == '1':
                    self.load_initial_data()
                elif choice == '2':
                    self.insert_review_data()
                elif choice == '3':
                    self.insert_product_data()
                elif choice == '4':
                    self.display_review_by_id()
                elif choice == '5':
                    self.display_distinct_categories()
                elif choice == '6':
                    self.count_high_star_reviews()
                elif choice == '7':
                    self.count_low_star_reviews()
                elif choice == '8':
                    self.search_reviews_by_title()
                elif choice == '9':
                    self.search_reviews_by_body()
                elif choice == '10':
                    self.delete_review()
                elif choice == '11':
                    self.delete_all_review_data()
                elif choice == '12':
                    self.delete_all_product_data()
                elif choice == '13':
                    self.display_statistics()
                else:
                    print("❌ Invalid choice. Please enter a number between 0-13.")
                
                input("\n⏸️  Press Enter to continue...")
                
            except KeyboardInterrupt:
                print("\n\n👋 Program interrupted by user. Goodbye!")
                break
            except Exception as e:
                print(f"❌ An unexpected error occurred: {e}")
                input("\n⏸️  Press Enter to continue...")

def main():
    """Main function to run the application"""
    try:
        app = AmazonReviewsDB()
        app.run()
    except Exception as e:
        print(f"❌ Fatal error: {e}")
        sys.exit(1)

if __name__ == "__main__":
    main()