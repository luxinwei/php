package com.dzqc.student.http;

/*****
 * 图片下载处理类
 * ******/
import java.io.File;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.utils.CachePathUtil;
import com.dzqc.student.utils.DensityUtils;
import com.nostra13.universalimageloader.cache.disc.impl.UnlimitedDiskCache;
import com.nostra13.universalimageloader.cache.disc.naming.Md5FileNameGenerator;
import com.nostra13.universalimageloader.cache.memory.impl.UsingFreqLimitedMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.FadeInBitmapDisplayer;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;
import com.nostra13.universalimageloader.core.download.BaseImageDownloader;

import android.content.Context;
import android.view.View;
import android.widget.ImageView;

public class HttpImage {

	private static ImageLoader imageLoader = null;

	@SuppressWarnings("deprecation")
	private static ImageLoader initImageLoader() {
		Context context = DzqcStu.getInstance();
		if (imageLoader == null) {
			imageLoader = ImageLoader.getInstance();
			File cacheDir = new File(CachePathUtil.getImgCachePath(context,
					context.getResources().getString(R.string.app_name)));
			if (!cacheDir.exists())
				cacheDir.mkdirs();
			ImageLoaderConfiguration config = new ImageLoaderConfiguration.Builder(
					context)
					// 线程池内加载的数量
					.threadPoolSize(3)
					// 设置正在运行任务的所有线程在系统中的优先级（1到10）
					.threadPriority(Thread.NORM_PRIORITY - 2)
					// 指令确保删除前一个加载的图像缓存的内存的大小
					.denyCacheImageMultipleSizesInMemory()
					// 最少被用到的对象会被删除
					.memoryCache(
							new UsingFreqLimitedMemoryCache(2 * 1024 * 1024))
					// 你可以通过自己的内存缓存实现
					.memoryCacheSize(5 * 1024 * 1024)
					// 将保存的时候的URI名称用MD5
					.discCacheFileNameGenerator(new Md5FileNameGenerator())
					.tasksProcessingOrder(QueueProcessingType.LIFO)
					.discCacheFileCount(200)
					// 缓存的文件数量
					// 自定义缓存路径
					.discCache(new UnlimitedDiskCache(cacheDir))
					.defaultDisplayImageOptions(
							DisplayImageOptions.createSimple())
					// 打印日志
					// .writeDebugLogs()
					// 超时时间
					.imageDownloader(
							new BaseImageDownloader(context, 5 * 1000,
									30 * 1000)).build();
			imageLoader.init(config);
		}
		return imageLoader;
	}

	// 获取图片
	public static void loadImage(ImageView imageView, String url) {
		DisplayImageOptions options = new DisplayImageOptions.Builder()
		// 启用内存缓存
				.cacheInMemory(true)
				// 启用外存缓存
				.cacheOnDisk(true)
				// 启用EXIF和JPEG图像格式
				.considerExifParams(true).build();
		initImageLoader().displayImage(url, imageView, options);
	}

	// 获取图片并设置默认图片
	public static void loadImage(ImageView imageView, String url,
			int default_image, int error_image) {
		DisplayImageOptions options;
		options = new DisplayImageOptions.Builder()
		// 设置图片在下载期间显示的图片
				.showImageOnLoading(default_image)
				// 设置图片Uri为空或是错误的时候显示的图片
				.showImageForEmptyUri(error_image)
				// 设置图片加载/解码过程中错误时候显示的图片
				.showImageOnFail(error_image)
				// 启用内存缓存
				.cacheInMemory(true)
				// 启用外存缓存
				.cacheOnDisk(true)
				// 是否考虑JPEG图像EXIF参数（旋转，翻转）
				.considerExifParams(true).resetViewBeforeLoading(true)
				// 是否图片加载好后渐入的动画时间
				.displayer(new FadeInBitmapDisplayer(100)).build();// 构建完成
		initImageLoader().displayImage(url, imageView, options);
	}

	// 获取图片并设置默认图片和弧度
	public static void loadImage(ImageView imageView, String url,
			int default_image, int error_image, int round) {
		DisplayImageOptions options;
		options = new DisplayImageOptions.Builder()
		// 设置图片在下载期间显示的图片
				.showImageOnLoading(default_image)
				// 设置图片Uri为空或是错误的时候显示的图片
				.showImageForEmptyUri(error_image)
				// 设置图片加载/解码过程中错误时候显示的图片
				.showImageOnFail(error_image)
				// 启用内存缓存
				.cacheInMemory(true)
				// 启用外存缓存
				.cacheOnDisk(true)
				// 是否图片加载好后渐入的动画时间
				.displayer(new FadeInBitmapDisplayer(100))
				// 设置圆角
				.displayer(
						new RoundedBitmapDisplayer(DensityUtils.dp2Px(
								DzqcStu.getInstance(), round))).build();// 构建完成
		initImageLoader().displayImage(url, imageView, options);

	}

}
